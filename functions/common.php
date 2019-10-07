<?php
function checkLogin(){
    return !empty(session("userinfo")['uid']);
}
