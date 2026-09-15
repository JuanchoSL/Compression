# Compression

## Description

Little methods collection in order to compress/uncompress strings or create/manage compressed files

## Install

```bash
composer require juanchosl/compression
```

## Data Compression

At first, we can compress/uncompress strings, it is not needed that use a regular file, can be used from/to http messages directly.

- Bzip2 (require bz2 extension) (https://www.php.net/manual/es/book.bzip2.php)
- Pure Gzip [RFC 1952](https://www.php.net/manual/en/function.gzencode.php)
- Lzf (require lzf extension) (https://www.php.net/manual/es/book.lzf.php)
- Gzip/Deflate (require zlib extension) [RFC 1951](https://www.php.net/manual/es/book.zlib.php)
- Brotli (require brotli extension) [Brotli](https://packagist.org/packages/kjdev/brotli)
- Zstd (require zstd extension) [Zstd](https://packagist.org/packages/kjdev/zstd)
- LZ4 (require lz4 extension) [LZ4](https://packagist.org/packages/kjdev/lz4)
- SNAPPY (require snappy extension) [Snappy](https://packagist.org/packages/kjdev/snappy)
- Xz/Lzma (require XZ extension) [XZ](https://github.com/mateuszanella/php-ext-xz)

## How to use

We can select from few extensions, in order to change the format between the available extensions or the specyfic need, with no code changes.

### Compatibility

Actually, the distincts modules have diferent compatibilities with some php versions. Actually we are test with the next available versions:

- Bzip2: From php v8.0 to php v8.6 (This is a native module included with all php versions)
- Gzip: From php v8.0 to php v8.6 (This is a native module included with all php versions)
- Lzf: From php v8.0 to php v8.5 [Pecl](https://packagist.org/packages/pecl/lzf)
- Zlib: From php v8.0 to php v8.6 (This is a native module included with all php versions)
- Brotli: From php v8.0 to php v8.5 [Kjdev](https://github.com/kjdev/php-ext-brotli)
- Zstd: From php v8.0 to php v8.5 [Kjdev](https://packagist.org/packages/kjdev/zstd)
- Lz4: From php v8.1 to php v8.5 [Kjdev](https://github.com/kjdev/php-ext-lz4)
- Snappy: From php v8.1 to php v8.4 [Kjdev](https://github.com/kjdev/php-ext-snappy)
- XZ: From php v8.0 to php v8.4 [with mateuszanella/php-ext-xz](https://github.com/mateuszanella/php-ext-xz) and php v8.5 [with codemasher/php-ext-xz](https://github.com/codemasher/php-ext-xz)

### Plain text/data

#### Compress

```php
$format = new CompressionBrotli($level = 8);
$compressed_text = $format->compress($uncompressed_text);
```

#### Uncompress

```php
$format = new CompressionZstd();
$uncompressed_text = $format->decompress($compressed_text);
```

### Files

The file handlers modules, are providing us the availability to manage compressed files or create a new one, with an unifyed interface, in order to change the used extension with no needs to do changes into code, only changing the instance using factories, we can use one available extension or other.

Actually we can Readers and Writer into separated classes

#### File Reader

For read a compressed file, we can instantiate the knowed extension with the filepath and read the contents as a regular file. Some extensions, can manage partial uncompressing, but other does not, with this restriction, we are unificating internally the differences using a memory handler when is required, in order to avoid that the consumer code needs to do it, abstracting it

```php
$handler = new Bzip2FileReader("/path/to/file");
while($data = $handler->read(2048)){
    echo $data . PHP_EOL;
}
```

As alternative, we have available an iterator that do it, only needs use the file handler as a callable function. This is available into the FileReaderHandlers that are implementing the Stringable Interface

```php
$handler = new Bzip2FileReader("/path/to/file");
while($data = $handler(2048)){
    echo $data . PHP_EOL;
}
```

```php
$handler = new Bzip2FileReader("/path/to/file");
echo (string) $data;
```

#### File Writer

In order to create a new compressed file, we need to instantiate the destiny path. As Readers, some extensions can manage partials deflatings, but the ones than can not, works internally with a memory file handler, mantaining the write data before the compress it when the close file has performed. This ones can use more memory that other extensions, but it provides a more compatibility structure with more available extensions to use.

```php
$handler = new BrotliFileWriter("/path/to/file");
while($data = $alternative_origin->getData()){
    $handler->write($data);
}
$handler->close();
```

If only needs to compress a previously existing file, simple to use executing the static compress function from a XXXFileWriter that are implenmenting the FileCreateableInterface, adding the rigth extension to a new compressed file into the same directory that original. For select a distinct destiny path, use the second parameter for indicate the full file path name. The assigned extension to final file is always checked and added when it is not provided from the second parameter.

No destiny path provided
```php
$new_compressed_file_path = ZstdFileWriter::compress("/path/uncompressed/path/file");
echo $new_compressed_file_path;// /path/uncompressed/path/file.zst
```

Same destiny path indicated
```php
$new_compressed_file_path = ZstdFileWriter::compress("/path/uncompressed/path/file","/path/uncompressed/path/file");
echo $new_compressed_file_path;// /path/uncompressed/path/file.zst
```

Distinct destiny path indicated
```php
$new_compressed_file_path = ZstdFileWriter::compress("/path/uncompressed/path/file","/other/path/file");
echo $new_compressed_file_path;// /other/path//file.zst
```

Destiny path indicated with wrong extension
```php
$new_compressed_file_path = ZstdFileWriter::compress("/path/uncompressed/path/file","/path/uncompressed/path/file.br");
echo $new_compressed_file_path;// /path/uncompressed/path/file.br.zst
```
