<?php

function construct() {}

function indexAction()
{
    load_view('teamIndex');
}

function loginAction()
{
    load_view('login');
}


function logoutAction()
{
  unset($_SESSION['is_login']);
  unset($_SESSION['user_login']);
  redirect("?mod=users&action=login");
}