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