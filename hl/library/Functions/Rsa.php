<?php
namespace hl\library\Functions;
/**
** @ClassName: Rsa
** @Description: php-rsa 加密解密
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年4月23日 晚上22:49
** @version V1.0
*/
class Rsa
{
    /*
    ** 公钥
    */
    private $publicKey;
    
    /*
    ** 私钥
    */
    private $privateKey;
    
    /*
    ** 证书密码
    */
    private $passphrase;

    public function __construct($private_key_filepath, $public_key_filepath, $passphrase = '') 
    {
        $this->privateKey = $this->_getContents($private_key_filepath);
        $this->publicKey = $this->_getContents($public_key_filepath);
        $this->passphrase = $passphrase;
    }

    /**
    ** 获取文件内容
    ** 
    ** @param $file_path string
    ** @return bool|string
    */
    private function _getContents($file_path) 
    {
        file_exists($file_path) or die ('密钥或公钥的文件路径错误');
        return file_get_contents($file_path);
    }

    /**     
    ** 获取私钥
    ** 
    ** @return bool|resource     
    */ 
    private function _getPrivateKey() 
    {
        $priv_key = $this->privateKey;
        if ($this->passphrase) {
            return openssl_pkey_get_private($priv_key);
        } else {
            return openssl_pkey_get_private($priv_key, $this->passphrase);
        }
       
    }

    /**     
    ** 获取公钥
    ** 
    ** @return bool|resource     
    */    
    private function _getPublicKey() 
    {        
        $public_key = $this->publicKey;
        return openssl_pkey_get_public($public_key);
    }

    /**     
    ** 私钥加密
    ** 
    ** @param string $data     
    ** @return null|string     
    */    
    public function privEncrypt($data = '') 
    {        
        if (!is_string($data)) {
            return null;       
        }
        return openssl_private_encrypt($data, $encrypted, $this->_getPrivateKey()) ? base64_encode($encrypted) : null;
    }

    /**     
    ** 公钥加密     
    ** 
    ** @param string $data     
    ** @return null|string     
    */
    public function publicEncrypt($data = '') 
    {        
        if (!is_string($data)) {
            return null;        
        }        
        return openssl_public_encrypt($data, $encrypted, $this->_getPublicKey()) ? base64_encode($encrypted) : null;
    }

    /**     
    ** 私钥解密     
    ** 
    ** @param string $encrypted     
    ** @return null     
    */    
    public function privDecrypt($encrypted = '') 
    {        
        if (!is_string($encrypted)) {
            return null;        
        }
        return (openssl_private_decrypt(base64_decode($encrypted), $decrypted, $this->_getPrivateKey())) ? $decrypted : null;
    }    

    /**     
    ** 公钥解密   
    **   
    ** @param string $encrypted     
    ** @return null     
    */    
    public function publicDecrypt($encrypted = '') 
    {        
        if (!is_string($encrypted)) {
            return null;        
        }        
        return (openssl_public_decrypt(base64_decode($encrypted), $decrypted, $this->_getPublicKey())) ? $decrypted : null;
    }
}
