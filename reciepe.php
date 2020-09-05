<?php 
	let reciepes = {}
	reciepes["Bomb"] = {
			"cNiceName": "Bomb",
			"Returns": 1,
			"RequiredElectronicPart": 1, 
			"RequiredExplosivePart": 3, 
			"Illegal": true,
			}
			
	reciepes["Mine"] = {
		"cNiceName": "Bomb",
		"Returns": 1,
		"RequiredElectronicPart": 1, 
		"RequiredExplosivePart": 3, 
		"Illegal": true,
		"Frozen": true,
		}
		
	reciepes["Flashbang"] = {
		"cNiceName": "Flashbang",
		"Returns": 4,
		"RequiredExplosivePart": 1, 
		"RequiredCartridges": 4, 
		}
		
		
	reciepes["HE grenade"] = {
		"cNiceName": "HE grenade",
		"Returns": 2,
		"RequiredExplosivePart": 1, 
		"RequiredCartridges": 4, 
		"Illegal": true,
		}
		
		
	reciepes["Molotov"] = {
		"cNiceName": "Molotov",
		"Returns": 1,
		"RequiredExplosivePart": 1, 
		"RequiredCartridges": 1, 
		"Illegal": true,
		}
		
		
	reciepes["Smoke grenade"] = {
		"cNiceName": "Smoke grenade",
		"Returns": 2,
		"RequiredPyrophoric": 1, 
		"RequiredMedical": 2, 
		"RequiredCartridges": 2, 
		}
		
		
	reciepes["Body armor"] = {
		"cNiceName": "Body armor",
		"Returns": 1,
		"RequiredKevlar": 3, 
		}
		
		
	reciepes["Helmet + body armor"] = {
		"cNiceName": "Helmet + body armor",
		"Returns": 1,
		"RequiredKevlar": 5, 
		}
		
		
	reciepes["USP"] = {
		"cNiceName": "USP",
		"Returns": 1,
		"RequiredWeaponPart": 2, 
		"RequiredAmmunition": 1, 
		"Illegal": true,
		}
		
	reciepes["P250"] = {
		"cNiceName": "P250",
		"Returns": 1,
		"RequiredWeaponPart": 2, 
		"RequiredAmmunition": 1, 
		"Illegal": true,
		}
		
	reciepes["MAC-10"] = {
		"cNiceName": "MAC-10",
		"Returns": 1,
		"RequiredWeaponPart": 2, 
		"RequiredAmmunition": 2, 
		"Illegal": true,
		}
		
	reciepes["UMP-45"] = {
		"cNiceName": "UMP-45",
		"Returns": 1,
		"RequiredWeaponPart": 2, 
		"RequiredAmmunition": 2, 
		"Illegal": true,
		}
	reciepes["AK-47"] = {
		"cNiceName": "AK-47",
		"Returns": 1,
		"RequiredWeaponPart": 3, 
		"RequiredAmmunition": 2, 
		"Illegal": true,
		}
	reciepes["M4A1-S"] = {
		"cNiceName": "M4A1-S",
		"Returns": 1,
		"RequiredWeaponPart": 3, 
		"RequiredAmmunition": 2, 
		"Illegal": true,
		}
	reciepes["M4A4"] = {
		"cNiceName": "M4A4",
		"Returns": 1,
		"RequiredWeaponPart": 3, 
		"RequiredAmmunition": 2,
		"Illegal": true,
		}
	reciepes["AWP"] = {
		"cNiceName": "AWP",
		"Returns": 1,
		"RequiredWeaponPart": 5,
		"RequiredAmmunition": 3, 
		"Illegal": true,
		}
	reciepes["Ammunition"] = {
		"cNiceName": "Ammunition",
		"Returns": 3,
        "RequiredCartridges": 3,
        "RequiredPyrophoric": 1,
        "RequiredSteel": 1,
		"Illegal": true,
		
		}
	reciepes["ElectronicPart"] = {
		"cNiceName": "ElectronicPart",
		"RequiredElecktrum": 3,
		"RequiredPlatinum": 40,
		"NeedsOvenUses": 1,
		"Returns": 1,
		"StoveUsage": true,
		}
	reciepes["ExplosivePart"] = {
		"cNiceName": "ExplosivePart",
		"RequiredPyrophoric": 4,
		"RequiredSteel": 1,
		"Returns": 1,
		"Illegal": true,
		"Frozen": true,
		}
	reciepes["WeaponPart"] = {
		"cNiceName": "WeaponPart",
		"RequiredSteel": 5,
		"Returns": 1,
		}
	reciepes["Healthshot"] = {
		"cNiceName": "Healthshot",
		"Returns": 1,
		"RequiredPlatinum": 20,
		"RequiredMedical": 4,
		}
	reciepes["Tank"] = {
		"cNiceName": "Tank",
		"Illegal": true,
		"Returns": 1,
		"RequiredStrengthSerum": 5,
		"RequiredKevlar": 3,
		}
	reciepes["Carepackage"] = {
		"cNiceName": "Carepackage",
		"Returns": 1,
		"RequiredCurrencyGuardCoins": 400,
		}
	reciepes["Lootpackage"] = {
		"cNiceName": "Lootpackage",
		"Returns": 1,
		"RequiredCurrencyPlatinum": 40,

		}
	reciepes["Elecktrum"] = {
		"cNiceName": "Elecktrum",
		"RequiredGold": 16,
		"RequiredSilver": 4,
		"NeedsOvenUses": 1,
		"Returns": 1,
		"StoveUsage": true,
		}
	reciepes["Steel"] = {
		"cNiceName": "Steel",
		"RequiredIron": 20,
		"NeedsOvenUses": 1,
		"Returns": 1,
		"StoveUsage": true,
		}
	reciepes["Pyrophoric"] = {
		"Illegal": true,
		"Frozen": true,
		"cNiceName": "Pyrophoric",
		"RequiredIron": 4,
		"RequiredPhosphorus": 16,
		"Returns": 1,
		}
	reciepes["Cartridges"] = {
		"cNiceName": "Cartridges",
		"RequiredCopper": 16,
		"RequiredGold": 4,
		"NeedsOvenUses": 1,
		"Returns": 1,
		"Illegal": true,
		"StoveUsage": true,
		}
	reciepes["Medical"] = {
		"cNiceName": "Medical",
		"RequiredPenicillin": 20,
		"Returns": 1,
		}
	reciepes["Freeday"] = {
		"cNiceName": "Freeday",
		"RequiredCurrencyGuardCoins": 250,
		"Returns": 1,
		}
	reciepes["Antiserum"] = {
		"cNiceName": "Antiserum",
		"Collectable": true
		}
	reciepes["Strength Serum"] = {
		"cNiceName": "Strength Serum",
		"Collectable": true
		}
	reciepes["Luck Potion"] = {
		"cNiceName": "Luck Potion",
		"Collectable": true,
		}
	reciepes["Kevlar"] = {
		"cNiceName": "Kevlar",
		"RequiredFiber": 20,
		"Returns": 1,
		}
	?>