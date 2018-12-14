FluxCP Addon [Vote for Points]
=====================

## Features
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

## Compability
- Tested on Xantara's FluxCP for rAthena - https://github.com/m...ntara/fluxcp-rA

## Rules
- Do not steal the credit of this work.

## Requirements
- PHP 5.2+
- MySql

# Installation

1. Create a folder named `voteforpoints` in your `flux_root_folder/addons` folder.

2. Download this addon and extract all the files into the `voteforpoints` folder.

3. Import the sql files from `schemas/logindb` folder.

4. Create a folder in `flux_root_folder/themes/default/img/votes/` or replace `votes` with whichever name you use in the configuration.

5. Give permissions to the `flux_root_folder/themes/default/img/votes/` folder so that your flux website can upload images. You can do this by using the terminal, going to the `flux_root_folder/themes/default/img/` directory and typing `chmod 777 votes`.

6. Copy the file `voteforpoints.txt` from npc folder and paste it to your `rAthena_root_folder/npc/custom/`

7. Edit the file `scripts_custom.conf` and add the line `npc: npc/custom/voteforpoints.txt`

8. Change the settings in `voteforpoints` to your liking.

9. Done

## Contacts

If you find a bug, please contact me.

Github: http://github.com/Feefty  
Email: kingfeefty@gmail.com  
rAthena: Feefty

Feel free to buy me a coffee  
Paypal: keinstah@gmail.com
