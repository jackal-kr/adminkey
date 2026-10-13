Installation

Go to Admin → System → Install Extensions
Upload the plg_adminkey.zip file
Go to Admin → System → Plugins
Search for "Admin Secret Key"
Enable it
Click to edit it and set your Secret Key — something hard to guess, e.g. G7kx92mQ (avoid simple words)
Save & Close


How it works

Without the key: visiting /administrator/ redirects to your homepage
With the key: /administrator/?G7kx92mQ → lets you through, remembers you for the whole session
Once you log into Joomla normally, the session is maintained — you won't need the key on every click


⚠️ Important — bookmark the URL

Before enabling, bookmark:
https://dojazdowdzialki.pl/administrator/?YourSecretKey
If you forget the key and get locked out, you'd need FTP access to delete the plugin file from public_html/plugins/system/adminkey/.
