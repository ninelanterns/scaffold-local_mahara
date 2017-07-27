<?php

$observers = array(
    array(
        'eventname'   => 'core\\event\\user_deleted',
        'callback'    => 'local_cohortbuilder\\observer::user_deleted',
        'internal'  => false,
    ),
);
