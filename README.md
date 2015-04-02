
## Specification

### Folder Structure

+ /web
  + /static
    + /semantic-ui
  + /css : custom css
  + /js : custom js
  + /admin
    + /auth : db authencation
      + db_auth.php
    + login.php
    + logout.php
  + /hrdb : Human Resource Database
  + /boss : What boss see
  + /template

### DB Structure

+ db_lab1.sql
+ user: db_lab1
+ tables:
    + employer
    + location
    + occupation
    + recruit
    + specialty
    + user
    + user_specialty

### Session Varibles
  + is_authed
    + True for logined
    + False for visitors
  + is_user : True for identity is user
    + user_id
    + user_name
  + is_boss : True for identity is admin
    + boss_id
    + boss_name

### Foreign Keys
+ location
    + Taipei
    + New Taipei
    + HsinChu
    + Taoyuan
    + Taichung
    + Tainan
    + Kaohsiung
+ occupation
    + Pusheen
    + Tuzki
    + Mugsy
    + Bun
    + Minion
    + Pandadog
    + Koko
+ specialty
    + sleep
    + eat
    + kiss
    + blink
    + break the cup
    + bully the boss
