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
- Brotli (require brotli extension)
- Zstd (require zstd extension)

## How to use

We can select from few extensions, in order to change the format between the available extensions or the specyfic need, with no code changes.

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