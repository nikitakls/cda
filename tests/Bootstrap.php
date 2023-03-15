<?php /** @noinspection PhpIncludeInspection */
/**
 * The MIT License
 *
 * Copyright 2018  Peter Gee <https://github.com/pgee70>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

system('clear');
$now = new \DateTime(null, new \DateTimeZone('Australia/Hobart'));
echo "Unit test begins on {$now->format('H:i:s T dS F Y')}\n";
if (!defined('ENVIRONMENT')) {
    define('ENVIRONMENT', 'testing');
}

error_reporting(-1);
ini_set('display_errors', 1);

spl_autoload_register(function ($className)
{
    if (strpos($className, 'PHPHealth\tests') === 0) {
        $className = str_replace(["PHPHealth\\tests\\", "\\"], ['', DIRECTORY_SEPARATOR], $className);
        $filename = './' . $className . '.php';
        if (file_exists($filename)) {
            include_once $filename;
        }
        else {
            echo "the file $filename as was not found!";
        }

    } else {
        $className = str_replace(["PHPHealth\\CDA\\", "\\"], ['', DIRECTORY_SEPARATOR], $className);
        /** @noinspection PhpIncludeInspection */
        $filename = '../lib/' . $className . '.php';
        if (file_exists($filename)) {
            include_once $filename;
        }
        else {
            echo "the file $filename as was not found!";
        }
    }
});