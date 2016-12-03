# MongoDB-PHP7-Tutorial
A small example of a blog using MongoDB with PHP7. It has no authentication, only posts and comments. It is focused on learning to use MongoDB with PHP7.

## It was tested with:

1. PHP 7.0.8
2. MongoDB 3.2.11
3. mongodb 1.1.9 driver
4. Apache 2.4.18
5. Ubuntu 16.04.1 LTS

## Functionality

1. **Read blog:** show posts and comments
2. **Add post**
3. **Edit post**
4. **Delete post:** it also deletes its comments
5. **Add comment**
6. **Edit comment**
7. **Delete comment**

## Database Scheme

![Database scheme seen in RoboMongo](https://github.com/adam-p/markdown-here/raw/master/src/common/images/icon48.png "Logo Title Text 1")

## Project description

1. lib_php
⋅⋅1. **bd.php:** functions to access mongodb (most important file I'd say)
⋅⋅2. **config.php:** app config file (change routes to php services and mongodb access configuration here)
⋅⋅3. **html_vuilder.php:** functions to build blog's html
⋅⋅4. **include.php:** don't mind this one
2. **index.php**
3. **servicio_add_comment:** JSON POST service to add a comment
4. **servicio_add_post:** JSON POST service to add a post
5. **servicio_delete_comment:** JSON POST service to delete a comment
6. **servicio_delete_post:** JSON POST service to delete a post
7. **servicio_edit_comment:** JSON POST service to edit a comment
8. **servicio_edit_post:** JSON POST service to edit a post
8. **servicio_reload_posts:** JSON GET service to get all posts and comments (it's not used in the index)

## More information

1. [MongoDB Official documentation](https://docs.mongodb.com/)
2. [MongoDB Driver PHP info](https://secure.php.net/manual/en/set.mongodb.php)
3. [MongoDB Tutorial](https://www.tutorialspoint.com/mongodb/index.htm)
4. [RoboMongo (GUI)](https://robomongo.org/)
