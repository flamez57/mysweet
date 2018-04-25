<h5>函数库</h5>

<hr>
<h5>Rsa(php-rsa 加密解密)</h5>

1.什么是RSA加密

    根据密钥的使用方法，可以将密码分为对称密码和公钥密码。
    对称密码：加密和解密使用同一种密钥的方式，常用的算法有 DES 以及 AES。
    公钥密码：加密和解密使用不同的密码的方式，因此公钥密码通常也称为非对称密码，常用的算法有 RSA。

2.使用场景

  ● 为移动端（IOS，安卓）编写 API 接口<br>
  ● 进行支付、真实信息验证等安全性需求较高的通信<br>
  ● 与其他第三方或合作伙伴进行重要的数据传输<br>

3.生成私钥、公钥

    既然 RSA 是非对称加密，那么就先必须生成所需要的私钥和公钥，以 ubuntu 为例。
    首先下载开源 RSA 密钥生成工具 openssl （通常为 linux 系统自带），如果没有，可以通过以下命令进行安装
    apt-get install openssl

    当 openssl 安装完毕后，我们就可以开始生成私钥、公钥了。首先，生成原始 RSA 私钥文件
    openssl genrsa -out rsa_private_key.pem 1024

    注：这里生成了一个长度为 1024bit 的密钥，转化为字节就是 128byte
    其次，将原始 RSA 私钥转换为 pkcs8 格式
    openssl pkcs8 -topk8 -inform PEM -in rsa_private_key.pem -outform PEM -nocrypt -out private_key.pem

    最后，生成 RSA 公钥
    openssl rsa -in rsa_private_key.pem -pubout -out rsa_public_key.pem

    在需要使用的时候，我们将私钥 rsa_private_key.pem 放在服务器端，公钥发放给需要与我们进行加密通信的一方就可以了。

    也可以利用在线工具生成秘钥对http://web.chacuo.net/netrsakeypair 如果添加了证书密码后实例化的时候要求有第三个参数（证书密码）。

4.php-rsa 加密解密实例

    首先要看看你有没有安装或开启 php 的 openssl 扩展

    $private_key = ROOT_PATH.'data'.DIRECTORY_SEPARATOR.'key'.DIRECTORY_SEPARATOR.'private_key.pem'; // 私钥路径
    $public_key = ROOT_PATH.'data'.DIRECTORY_SEPARATOR.'key'.DIRECTORY_SEPARATOR.'public_key.pem'; // 公钥路径
    $rsa = new \hl\library\Functions\Rsa($private_key, $public_key);
    $origin_data = 'this is a test data';
    $ecryption_data = $rsa->privEncrypt($origin_data);
    $decryption_data = $rsa->publicDecrypt($ecryption_data);

    echo '私钥加密后的数据为：' . $ecryption_data . PHP_EOL;
    echo '公钥解密后的数据为: ' . $decryption_data . PHP_EOL;

    最后要说明的是，公钥、私钥都可以加密，也都可以解密。其中：用公钥加密需要私钥解密，称为“加密”。
    由于私钥是不公开的，确保了内容的保密，没有私钥无法获得内容；用私钥加密需要公钥解密，称为“签名”。
    由于公钥是公开的，任何人都可以解密内容，但只能用发布者的公钥解密，验证了内容是该发布者发出的。

<hr>
<h5>Sha2</h5>

<h6>sha256</h6>

    /*
    ** @param string $data 要计算散列值的字符串
    ** @param boolean $rawOutput 为true时返回原始二进制数据，否则返回字符串
    ** @return boolean | string 参数无效或者文件不存在或者文件不可读时返回false，计算成功则返回对应的散列值
    */
    \hl\library\Functions\Sha2::sha256($data, $rawOutput = false);

<h6>sha256_file()</h6>  

    /*
    ** @param string file 要计算散列值的文件名，可以是单独的文件名，也可以包含路径，绝对路径相对路径都可以
    ** @param boolean $rawOutput 为true时返回原始二进制数据，否则返回字符串
    ** @return boolean | string 参数无效或者文件不存在或者文件不可读时返回false，计算成功则返回对应的散列值
    */      
    \hl\library\Functions\Sha2::sha256_file($file, $rawOutput = false);

<h6>sha512()</h6>

    /*
    ** @param string $data 要计算散列值的字符串
    ** @param boolean $rawOutput 为true时返回原始二进制数据，否则返回字符串
    ** @return boolean | string 参数无效或者文件不存在或者文件不可读时返回false，计算成功则返回对应的散列值
    */
    \hl\library\Functions\Sha2::sha512($data, $rawOutput = false);

<h6>sha512_file()</h6>
    
    /*
    ** @param string file 要计算散列值的文件名，可以是单独的文件名，也可以包含路径，绝对路径相对路径都可以
    ** @param boolean $rawOutput 为true时返回原始二进制数据，否则返回字符串
    ** @return boolean | string 参数无效或者文件不存在或者文件不可读时返回false，计算成功则返回对应的散列值
    */ 
    \hl\library\Functions\Sha2::sha512_file($file, $rawOutput = false);  
