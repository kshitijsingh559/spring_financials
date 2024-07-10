<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:declare-winners')->everyFiveMinutes();
