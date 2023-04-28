<?php

    $con = mysqli_connect("localhost","root","");
    //creating sb if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS contact";
    if(mysqli_query($con, $sql)){
    

        //pdo object
        $connect = new PDO("mysql:host=localhost;dbname=contact", "root", "");
        //mysqli object
        $con = mysqli_connect("localhost", "root", "", "contact");
        //contact table schema
        $sql = "
        CREATE TABLE IF NOT EXISTS contacts (
            id int(11) NOT NULL AUTO_INCREMENT ,
            contact_name VARCHAR (50) NOT NULL,
            contact_number VARCHAR (20) NOT NULL,
            contact_email VARCHAR (50) NOT NULL,
            contact_address VARCHAR (50),
            user_email VARCHAR (50),
            PRIMARY KEY(id)
           );
           ";
        //error msg
        if(!mysqli_query($con, $sql)){
            echo "Cannot Create table...!";
        }
        //users table
        $sql = "
        CREATE TABLE IF NOT EXISTS users (
            id int(11) NOT NULL AUTO_INCREMENT ,
            name varchar(50) NOT NULL,
            email varchar(50) NOT NULL,
            pass varchar(50) NOT NULL,
            PRIMARY KEY(id)
           );
           ";
        //error msg
        if(!mysqli_query($con, $sql))
        {
            echo "Cannot Create table...!";
        }
    }
    else{
        echo "error";
    }

?>