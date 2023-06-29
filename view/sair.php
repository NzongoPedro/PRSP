<?php

session_destroy();

header('location:' . ROUTE . '?page=home');
