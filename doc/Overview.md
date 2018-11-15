#Overview


## Create a game

POST `/api/games`

###Body 

    {
        "title": "space invador",
        "description": "in the space",
        "maxPlayer": 0
    }
    
## Create Player

###First the game master

POST `api/players`

####Body

    {
      "name": "Regis",
      "picture": "json_encode(md6)",
      "gameMaster": "/api/games/1",
      "race": "/api/races/1",
      "job": "/api/jobs/1",
      "gender": "/api/genders/1"
    }

###First the player

POST `api/players`

####Body

    {
      "name": "Regis",
      "picture": "json_encode(md6)",
      "game": "/api/games/1",
      "race": "/api/races/1",
      "job": "/api/jobs/1",
      "gender": "/api/genders/1"
    }
    
##Start Game

Only game master

###header

Authorization -> user_token

PUT `/api/games/start/{game_id}`
    
##End Game

Only game master

Authorization -> user_token

PUT `/api/games/end/{game_id}`
    
##Finish Game

Only game master

Authorization -> user_token

PUT `/api/games/finish/{game_id}`
    
##Player In User

Player in Use
Start to play with a player
PUT `/api/players/in_use/{id}`

return

    {
      "@context": "/api/contexts/Player",
      "@id": "/api/players/8",
      "@type": "Player",
      "id": 8,
      "name": "hagrid",
      "level": null,
      "experience": null,
      "life": null,
      "maneuverability": null,
      "attackPower": null,
      "defense": null,
      "parade": null,
      "gold": null,
      "token": "171274703",
      "game": "/api/games/4",
      "gameMaster": null,
      "inUse": true,
      "race": "/api/races/1",
      "job": "/api/jobs/1",
      "gender": "/api/genders/1",
      "protections": [],
      "weapons": [
        "/api/weapons/1",
        "/api/weapons/2"
      ],
      "objectItems": []
    }
    
    The token should be set in the cookies
    
##Modify skills of the player

MAster game can change the skills
Token of the master player should be send

Authorization -> user_token

PUT `/api/players/{id}`

body

    {
      "level": 0,
      "experience": 0,
      "life": 0,
      "maneuverability": 0,
      "attackPower": 0,
      "defense": 0,
      "parade": 0,
      "gold": 0,
      "picture": "json_encode(md6)",
      "inUse": true,
      "race": "/api/races/1",
      "job": "/api/jobs/1",
      "gender": "/api/genders/1",
      "protections": [
        "/api/protections/1",
        "/api/protections/2"
      ],
      "weapons": [
        "/api/weapons/1",
        "/api/weapons/2"
      ],
      "objectItems": [
        "/api/objectItems/1",
        "/api/objectItems/2"
      ]
    }


##Roll Dice

###body
POST `/api/rolls`

    {
      "player": "/api/players/8",
      "dices": [ 
        {
           "diceType": "/api/dice_types/1"
    },
        {
           "diceType": "/api/dice_types/2"
    }
      ]
    }
    
## GAME LIST
 
 GET `/api/games`
 
##Filters
 
     order[creationDate]
     order[id]
     title
     isFinish
