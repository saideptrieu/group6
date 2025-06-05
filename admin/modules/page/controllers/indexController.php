<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function listPostAction()
{
    load_view('listPost');
}

function addPageAction()
{
    load_view('addPage');
}

function listPageAction()
{
    load_view('listPage');
}

function addPostAction()
{
    load_view('addPost');
}

function listCatAction()
{
    load_view('listCat');
}

function listProductAction()
{
    load_view('listProduct');
}

function addProductAction()
{
    load_view('addProduct');
}

function listCustomerAction()
{
    load_view('listCustomer');
}

function listOrderAction()
{
    load_view('listOrder');
}

function menuAction()
{
    load_view('menu');
}

function addSliderAction()
{
    load_view('addSlider');
}

function listSliderAction()
{
    load_view('listSlider');
}

function addWidgetAction()
{
    load_view('addWidget');
}

function listWidgetAction()
{
    load_view('listWidget');
}

function updateAction() {}
