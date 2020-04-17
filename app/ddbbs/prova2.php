<?php

      return[
          'database'=>[
              'name'=>'prova2',
              'username'=>'prova2',
              'password'=>'prova2',
              'connection'=>'mysql:host=localhost',
              'options'=>[
                  PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8",
                  PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_PERSISTENT=>true
              ]
          ]
      ];
