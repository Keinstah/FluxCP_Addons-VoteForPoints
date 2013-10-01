FluxCP Addon [Vote for Points]
=====================

Features:
- Vote Time Interval (Default: 12 hours)
- Time Left - Count down for the voting site to vote
- Points (Default: 1) [Credits, Vote Points, Cash Points*New] Vote Points.
- Add, Delete or Edit Voting Site
- List of all voting site.
- Able to upload the image for the voting site or use the Image URL instead.
- Vote Name to avoid the confusion of the voting site.
- Able to detect if the user is using proxy.
- Able to check if the user has already voted by its ip address.
- (new) Voters Log(Able to delete a voters log.)
- Able to buy items from NPC Shop in game or redeem reward.

Compability:
- Tested on Xantara's FluxCP for rAthena - https://github.com/m...ntara/fluxcp-rA

Rules:
- Do not steal the credit of this work.

How to Install:
- Create a folder named voteforpoints in your addons folder.
- Extract all the files in voteforpoints folder.
- Import the sql files from schemas/logindb folder.
- Create a folder named votes or whatever name you use in the configuration and the path must for the folder be in /themes/default/img/
- Copy the file voteforpoints.txt from npc folder and paste it to your yourRAserver/npc/custom/
- Edit the file scripts_custom.conf and add the line npc: npc/custom/voteforpoints.txt
- Change the settings in voteforpoints to your liking.
- Done.

Required:
- PHP 5.2+
- MySql

If you find a bug, please contact me.

Github: http://github.com/Feefty  
Email: kingfeefty@gmail.com  
rAthena: Feefty

Feel free to buy me a coffee  
Paypal: keinstah@gmail.com
