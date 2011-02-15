<?php
/**
 * Rosemary Filter by Big Spaceship. 2011
 *
 * To contact Big Spaceship, email info@bigspaceship.com or write to us at 45 Main Street #716, Brooklyn, NY, 11201.
 * Visit http://labs.bigspaceship.com for documentation, updates and more free code.
 *
 *
 * Copyright (c) 2006-2009 Big Spaceship, LLC
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
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 **/

/**
 * Conditionals
 * Allows you to use conditional statements in your code
 *
 *
 * Usage:
 *
 *     if $_GET['variable'] == "something" then
 *         /** Css here * /
 *     end if
 *
 *
 * @author     Matt Kenefick
 * @company    Big Spaceship
 * @year       2011
 * @version    0.0.1
 * @url        http://www.bigspaceship.com
 */

    $filter          = new stdClass;
    $filter->name    = 'Conditionals';

    /**
    * Change Our Output
    */
    preg_match_all("/if ([^ ]+) (==|===|!=|!==|<|>|\|\||<=|>=) ([^ ]+) then\n(.*?)\nend if/im", $output, $variableBlock, PREG_SET_ORDER);
    list($base, $var1, $operator, $var2, $data)    =   $variableBlock[0];

    eval('$var3 = ' . "{$var1};");
    eval('$var4 = ' . "{$var2};");

    $equation   =   "if($var3 $operator $var4) {" . '$response = true; }';
    eval($equation);

    $output     =   str_replace("if $var1 $operator $var2 then\n", '', $output);
    $output     =   str_replace("end if", '', $output);

    if($response == true){
        //echo 'GOOD!';
    }else{
        $output     =   str_replace($data, '', $output);
    };
