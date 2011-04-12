<?php
/**
 * Rosemary Filter by Big Spaceship. 2009
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
 * FileSave
 * Saves a version of the outputted file
 *
 * @author     Matt Kenefick
 * @company    Big Spaceship
 * @year       2011
 * @version    1.0
 * @url        http://www.bigspaceship.com
 */

    $fh =   @fopen($docRoot . $rosemary . '.css', 'w');
    if($fh){
        fwrite($fh, $output);
        fclose($fh);
        chmod($docRoot . $rosemary . '.css', 0777);
    }else{
        // folder not writeable
    }
