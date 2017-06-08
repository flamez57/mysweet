<?php

/* Version 0.9, 6th April 2003 - Simon Willison ( http://simon.incutio.com/ )
   Manual: http://scripts.incutio.com/httpclient/
*/

class HttpClient {
    // Request vars
    var $host;
    var $port;
    var $path;
    var $method;
    var $postdata = '';
    var $cookies = array();
    var $referer;
    var $accept = 'text/xml,application/xml,application/xhtml+xml,text/html,text/plain,image/png,image/jpeg,image/gif,*/*';
    var $accept_encoding = 'gzip';
    var $accept_language = 'en-us';
    var $user_agent = 'Incutio HttpClient v0.9';
    // Options
    var $timeout = 20;
    var $use_gzip = true;
    var $persist_cookies = true;  // If true, received cookies are placed in the $this->cookies array ready for the next request
                                  // Note: This currently ignores the cookie path (and time) completely. Time is not important, 
                                  //       but path could possibly lead to security problems.
    var $persist_referers = true; // For each request, sends path of last request as referer
    var $debug = false;
    var $handle_redirects = true; // Auaomtically redirect if Location or URI header is found
    var $max_redirects = 5;
    var $headers_only = false;    // If true, stops receiving once headers have been read.
    // Basic authorization variables
    var $username;
    var $password;
    // Response vars
    var $status;
    var $headers = array();
    var $content = '';
    var $errormsg;
    // Tracker variables
    var $redirect_count = 0;
    var $cookie_host = '';
    function HttpClient($host, $port=80) {
        $this->host = $host;
        $this->port = $port;
    }
    function get($path, $data = false) {
        $this->path = $path;
        $this->method = 'GET';
        if ($data) {
            $this->path .= '?'.$this->buildQueryString($data);
        }
        return $this->doRequest();
    }
    function post($path, $data) {
        $this->path = $path;
        $this->method = 'POST';
        $this->postdata = $this->buildQueryString($data);
    	return $this->doRequest();
    }
    function buildQueryString($data) {
        $querystring = '';
        if (is_array($data)) {
            // Change data in to postable data
    		foreach ($data as $key => $val) {
    			if (is_array($val)) {
    				foreach ($val as $val2) {
    					$querystring .= urlencode($key).'='.urlencode($val2).'&';
    				}
    			} else {
    				$querystring .= urlencode($key).'='.urlencode($val).'&';
    			}
    		}
    		$querystring = substr($querystring, 0, -1); // Eliminate unnecessary &
    	} else {
    	    $querystring = $data;
    	}
    	return $querystring;
    }
    function doRequest() {
        // Performs the actual HTTP request, returning true or false depending on outcome
		if (!$fp = @fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout)) {
		    // Set error message
            switch($errno) {
				case -3:
					$this->errormsg = 'Socket creation failed (-3)';
				case -4:
					$this->errormsg = 'DNS lookup failure (-4)';
				case -5:
					$this->errormsg = 'Connection refused or timed out (-5)';
				default:
					$this->errormsg = 'Connection failed ('.$errno.')';
			    $this->errormsg .= ' '.$errstr;
			    $this->debug($this->errormsg);
			}
			return false;
        }
        socket_set_timeout($fp, $this->timeout);
        $request = $this->buildRequest();
        $this->debug('Request', $request);
        fwrite($fp, $request);
    	// Reset all the variables that should not persist between requests
    	$this->headers = array();
    	$this->content = '';
    	$this->errormsg = '';
    	// Set a couple of flags
    	$inHeaders = true;
    	$atStart = true;
    	// Now start reading back the response
    	while (!feof($fp)) {
    	    $line = fgets($fp, 4096);
    	    if ($atStart) {
    	        // Deal with first line of returned data
    	        $atStart = false;
    	        if (!preg_match('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $line, $m)) {
    	            $this->errormsg = "Status code line invalid: ".htmlentities($line);
    	            $this->debug($this->errormsg);
    	            return false;
    	        }
    	        $http_version = $m[1]; // not used
    	        $this->status = $m[2];
    	        $status_string = $m[3]; // not used
    	        $this->debug(trim($line));
    	        continue;
    	    }
    	    if ($inHeaders) {
    	        if (trim($line) == '') {
    	            $inHeaders = false;
    	            $this->debug('Received Headers', $this->headers);
    	            if ($this->headers_only) {
    	                break; // Skip the rest of the input
    	            }
    	            continue;
    	        }
    	        if (!preg_match('/([^:]+):\\s*(.*)/', $line, $m)) {
    	            // Skip to the next header
    	            continue;
    	        }
    	        $key = strtolower(trim($m[1]));
    	        $val = trim($m[2]);
    	        // Deal with the possibility of multiple headers of same name
    	        if (isset($this->headers[$key])) {
    	            if (is_array($this->headers[$key])) {
    	                $this->headers[$key][] = $val;
    	            } else {
    	                $this->headers[$key] = array($this->headers[$key], $val);
    	            }
    	        } else {
    	            $this->headers[$key] = $val;
    	        }
    	        continue;
    	    }
    	    // We're not in the headers, so append the line to the contents
    	    $this->content .= $line;
        }
        fclose($fp);
        // If data is compressed, uncompress it
        if (isset($this->headers['content-encoding']) && $this->headers['content-encoding'] == 'gzip') {
            $this->debug('Content is gzip encoded, unzipping it');
            $this->content = substr($this->content, 10); // See http://www.php.net/manual/en/function.gzencode.php
            $this->content = gzinflate($this->content);
        }
        // If $persist_cookies, deal with any cookies
        if ($this->persist_cookies && isset($this->headers['set-cookie']) && $this->host == $this->cookie_host) {
            $cookies = $this->headers['set-cookie'];
            if (!is_array($cookies)) {
                $cookies = array($cookies);
            }
            foreach ($cookies as $cookie) {
                if (preg_match('/([^=]+)=([^;]+);/', $cookie, $m)) {
                    $this->cookies[$m[1]] = $m[2];
                }
            }
            // Record domain of cookies for security reasons
            $this->cookie_host = $this->host;
        }
        // If $persist_referers, set the referer ready for the next request
        if ($this->persist_referers) {
            $this->debug('Persisting referer: '.$this->getRequestURL());
            $this->referer = $this->getRequestURL();
        }
        // Finally, if handle_redirects and a redirect is sent, do that
        if ($this->handle_redirects) {
            if (++$this->redirect_count >= $this->max_redirects) {
                $this->errormsg = 'Number of redirects exceeded maximum ('.$this->max_redirects.')';
                $this->debug($this->errormsg);
                $this->redirect_count = 0;
                return false;
            }
            $location = isset($this->headers['location']) ? $this->headers['location'] : '';
            $uri = isset($this->headers['uri']) ? $this->headers['uri'] : '';
            if ($location || $uri) {
                $url = parse_url($location.$uri);
                // This will FAIL if redirect is to a different site
                return $this->get($url['path']);
            }
        }
        return true;
    }
    function buildRequest() {
        $headers = array();
        $headers[] = "{$this->method} {$this->path} HTTP/1.0"; // Using 1.1 leads to all manner of problems, such as "chunked" encoding
        $headers[] = "Host: {$this->host}";
        $headers[] = "User-Agent: {$this->user_agent}";
        $headers[] = "Accept: {$this->accept}";
        if ($this->use_gzip) {
            $headers[] = "Accept-encoding: {$this->accept_encoding}";
        }
        $headers[] = "Accept-language: {$this->accept_language}";
        if ($this->referer) {
            $headers[] = "Referer: {$this->referer}";
        }
    	// Cookies
    	if ($this->cookies) {
    	    $cookie = 'Cookie: ';
    	    foreach ($this->cookies as $key => $value) {
    	        $cookie .= "$key=$value; ";
    	    }
    	    $headers[] = $cookie;
    	}
    	// Basic authentication
    	if ($this->username && $this->password) {
    	    $headers[] = 'Authorization: BASIC '.base64_encode($this->username.':'.$this->password);
    	}
    	// If this is a POST, set the content type and length
    	if ($this->postdata) {
    	    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    	    $headers[] = 'Content-Length: '.strlen($this->postdata);
    	}
    	$request = implode("\r\n", $headers)."\r\n\r\n".$this->postdata;
    	return $request;
    }
    function getStatus() {
        return $this->status;
    }
    function getContent() {
        return $this->content;
    }
    function getHeaders() {
        return $this->headers;
    }
    function getHeader($header) {
        $header = strtolower($header);
        if (isset($this->headers[$header])) {
            return $this->headers[$header];
        } else {
            return false;
        }
    }
    function getError() {
        return $this->errormsg;
    }
    function getCookies() {
        return $this->cookies;
    }
    function getRequestURL() {
        $url = 'http://'.$this->host;
        if ($this->port != 80) {
            $url .= ':'.$this->port;
        }            
        $url .= $this->path;
        return $url;
    }
    // Setter methods
    function setUserAgent($string) {
        $this->user_agent = $string;
    }
    function setAuthorization($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
    function setCookies($array) {
        $this->cookies = $array;
    }
    // Option setting methods
    function useGzip($boolean) {
        $this->use_gzip = $boolean;
    }
    function setPersistCookies($boolean) {
        $this->persist_cookies = $boolean;
    }
    function setPersistReferers($boolean) {
        $this->persist_referers = $boolean;
    }
    function setHandleRedirects($boolean) {
        $this->handle_redirects = $boolean;
    }
    function setMaxRedirects($num) {
        $this->max_redirects = $num;
    }
    function setHeadersOnly($boolean) {
        $this->headers_only = $boolean;
    }
    function setDebug($boolean) {
        $this->debug = $boolean;
    }
    // "Quick" static methods
    function quickGet($url) {
        $bits = parse_url($url);
        $host = $bits['host'];
        $port = isset($bits['port']) ? $bits['port'] : 80;
        $path = isset($bits['path']) ? $bits['path'] : '/';
        if (isset($bits['query'])) {
            $path .= '?'.$bits['query'];
        }
        $client = new HttpClient($host, $port);
        if (!$client->get($path)) {
            return false;
        } else {
            return $client->getContent();
        }
    }
    function quickPost($url, $data) {
        $bits = parse_url($url);
        $host = $bits['host'];
        $port = isset($bits['port']) ? $bits['port'] : 80;
        $path = isset($bits['path']) ? $bits['path'] : '/';
        $client = new HttpClient($host, $port);
        if (!$client->post($path, $data)) {
            return false;
        } else {
            return $client->getContent();
        }
    }
    function debug($msg, $object = false) {
        if ($this->debug) {
            print '<div style="border: 1px solid red; padding: 0.5em; margin: 0.5em;"><strong>HttpClient Debug:</strong> '.$msg;
            if ($object) {
                ob_start();
        	    print_r($object);
        	    $content = htmlentities(ob_get_contents());
        	    ob_end_clean();
        	    print '<pre>'.$content.'</pre>';
        	}
        	print '</div>';
        }
    }   
    public $host = "https://api.vdian.com/";
	/**
	 * Set timeout default.
	 *
	 * @ignore
	 *
	 *
	 *
	 *
	 */
	public $timeout = 30;
	/**
	 * Set connect timeout.
	 *
	 * @ignore
	 */
	public $connecttimeout = 30;
	/**
	 * Verify SSL Cert.
	 *
	 * @ignore
	 */
	public $ssl_verifypeer = FALSE;
	/**
	 * Respons format.
	 * @ignore
	 */
	public $format = 'json';
	/**
	 * Decode returned json data.
	 * @ignore
	 */
	public $decode_json = TRUE;
	/**
	 * Contains the last HTTP headers returned.
	 * @ignore
	 */
	public $http_info;
	/**
	 * Set the useragnet.
	 * @ignore
	 */
	private $useragent = 'weidian OAuth2 PHP SDK v1.0';
	
	/**
	 * boundary of multipart
	 * @ignore
	 */
	public static $boundary = '';
	public static function getInstance() {
		return new NetUtils ();
	}
	/**
	 * HTTP GET 请求
	 *
	 * @param unknown $url        	
	 * @return HttpResponse
	 */
	public function get($url) {
		if (strrpos ( $url, 'http://' ) !== 0 && strrpos ( $url, 'https://' ) !== 0) {
			$url = "{$this->host}{$url}.{$this->format}";
		}
		return $this->http ( $url, 'GET' );
	}
	/**
	 * POST request
	 *
	 * @param string $url        	
	 * @param array $parameters        	
	 * @return HttpResponse
	 */
	public function post($url, array $parameters) {
		if (strrpos ( $url, 'http://' ) !== 0 && strrpos ( $url, 'https://' ) !== 0) {
			$url = "{$this->host}{$url}.{$this->format}";
		}
		$body = null;
		if (DEBUG) {
			Logger::debug ( "URL->" . $url );
			if (is_array ( $parameters )) {
				while ( list ( $key, $val ) = each ( $parameters ) ) {
					Logger::debug ( $key . "=" . $val );
				}
			}
		}
		$body = http_build_query ( $parameters );
		return $this->http ( $url, 'POST', $body );
	}
	/**
	 * 发送HTTP请求
	 *
	 * @param string $url        	
	 * @param string $method        	
	 * @param unknown $parameters        	
	 * @param bool $multi        	
	 * @return HttpResponse
	 */
	public function request($url, $method, $parameters, $multi = false) {
		if (strrpos ( $url, 'http://' ) !== 0 && strrpos ( $url, 'https://' ) !== 0) {
			// 支持相对路径
			$url = "{$this->host}{$url}.{$this->format}";
		}
		
		switch ($method) {
			case 'GET' :
				$url = $url . '?' . http_build_query ( $parameters );
				return $this->http ( $url, 'GET' );
			default :
				$headers = array ();
				if (! $multi && (is_array ( $parameters ) || is_object ( $parameters ))) {
					$body = http_build_query ( $parameters );
				} else {
					$body = self::build_http_query_multi ( $parameters );
					$headers [] = "Content-Type: multipart/form-data; boundary=" . self::$boundary;
				}
				return $this->http ( $url, $method, $body, $headers );
		}
	}
	/**
	 * 上传文件
	 *
	 * @param unknown $url        	
	 * @param unknown $parameters        	
	 * @return Ambigous <string, mixed>
	 */
	public function uploadFile($url, $parameters) {
		$headers = array ();
		$body = self::build_http_query_multi ( $parameters );
		$headers [] = "Content-Type: multipart/form-data; boundary=" . self::$boundary;
		return self::http ( $url, 'POST', $body, $headers );
	}
	/**
	 * Make an HTTP request
	 *
	 * @return string API results
	 * @ignore
	 *
	 *
	 *
	 *
	 */
	private function http($url, $method, $postfields = NULL, $headers = array()) {
		$response = new HttpResponse ( $url, $headers, $method, $postfields );
		$ci = curl_init ();
		/* Curl settings */
		curl_setopt ( $ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0 );
		curl_setopt ( $ci, CURLOPT_USERAGENT, $this->useragent );
		curl_setopt ( $ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout );
		curl_setopt ( $ci, CURLOPT_TIMEOUT, $this->timeout );
		curl_setopt ( $ci, CURLOPT_RETURNTRANSFER, TRUE );
		curl_setopt ( $ci, CURLOPT_ENCODING, "UTF-8" );
		curl_setopt ( $ci, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifypeer );
		curl_setopt ( $ci, CURLOPT_SSL_VERIFYHOST, "1" );
		curl_setopt ( $ci, CURLOPT_HEADERFUNCTION, array (
				$this,
				'getHeader' 
		) );
		curl_setopt ( $ci, CURLOPT_HEADER, FALSE );
		
		switch ($method) {
			case 'POST' :
				curl_setopt ( $ci, CURLOPT_POST, TRUE );
				if (! empty ( $postfields )) {
					curl_setopt ( $ci, CURLOPT_POSTFIELDS, $postfields );
					$this->postdata = $postfields;
				}
				break;
			case 'DELETE' :
				curl_setopt ( $ci, CURLOPT_CUSTOMREQUEST, 'DELETE' );
				if (! empty ( $postfields )) {
					$url = "{$url}?{$postfields}";
				}
		}
		$headers [] = "API-RemoteIP: " . $_SERVER ['REMOTE_ADDR'];
		curl_setopt ( $ci, CURLOPT_URL, $url );
		curl_setopt ( $ci, CURLOPT_HTTPHEADER, $headers );
		curl_setopt ( $ci, CURLINFO_HEADER_OUT, TRUE );
		
		$response->data = curl_exec ( $ci );
		$response->http_code = curl_getinfo ( $ci, CURLINFO_HTTP_CODE );
		$response->http_info = array_merge ( $response->http_info, curl_getinfo ( $ci ) );
		$response->url = $url;
		if (DEBUG) {
			Logger::debug ( "headers:" );
			print_r ( $headers );
			Logger::debug ( "requestInfo:" );
			print_r ( curl_getinfo ( $ci ) );
			Logger::debug ( "body:" );
			print_r ( $postfields );
		}
		Logger::debug ( "返回:" . $response->data );
		curl_close ( $ci );
		return $response;
	}
	
	/**
	 *
	 * @ignore
	 *
	 *
	 *
	 */
	private function build_http_query_multi($params) {
		if (! $params)
			return '';
		
		uksort ( $params, 'strcmp' );
		
		$pairs = array ();
		
		self::$boundary = $boundary = uniqid ( '===============' );
		$MPboundary = '--' . $boundary;
		$endMPboundary = $MPboundary . '--';
		$multipartbody = '';
		
		foreach ( $params as $parameter => $value ) {
			
			if (in_array ( $parameter, array (
					'media' 
			) ) && $value {0} == '@') {
				$url = ltrim ( $value, '@' );
				$content = file_get_contents ( $url );
				$array = explode ( '?', basename ( $url ) );
				$filename = $array [0];
				
				$multipartbody .= $MPboundary . "\r\n";
				$multipartbody .= 'Content-Disposition: form-data; name="' . $parameter . '"; filename="' . $filename . '"' . "\r\n";
				$multipartbody .= "Content-Type: image/unknown\r\n\r\n";
				$multipartbody .= $content . "\r\n";
			} else {
				$multipartbody .= $MPboundary . "\r\n";
				$multipartbody .= 'content-disposition: form-data; name="' . $parameter . "\"\r\n\r\n";
				$multipartbody .= $value . "\r\n";
			}
		}
		
		$multipartbody .= $endMPboundary;
		return $multipartbody;
	}
	
	/**
	 * Get the header info to store.
	 *
	 * @return int
	 * @ignore
	 *
	 *
	 *
	 *
	 *
	 *
	 */
	function getHeader($ch, $header) {
		$i = strpos ( $header, ':' );
		if (! empty ( $i )) {
			$key = str_replace ( '-', '_', strtolower ( substr ( $header, 0, $i ) ) );
			$value = trim ( substr ( $header, $i + 2 ) );
			$this->http_header [$key] = $value;
		}
		return strlen ( $header );
	}
}

