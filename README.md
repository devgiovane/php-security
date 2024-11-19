<img src="./php.png" width="80" height="80" alt="logo" />

# PHP Security 

> My Study for security with PHP and JavaScript

## Concepts

- Payload Obfuscation

### Commands

Generate payload encoded
```bash
php -S 0.0.0.0:8001 -t public/
```

Interpret payload encoded
```bash
php src/index.php <secret_key> <payload>
```

Example
```bash
php src/index.php 12345678123456781234567812345678 '{"i":"4MEH/DoS36z7OD/L","t":"0Gux8CtxlcuwoWzqG5LDRQ==","d":"eOqEfQzwsJVMbk6D0SS8cdz+uyrgvg=="}'
```

### Create by
© [Giovane Santos](https://giovanesantossilva.github.io)