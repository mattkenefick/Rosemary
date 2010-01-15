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
 * Reset
 * This filter is used to prepend data to your css file
 * that will reset settings according to Yahoo!'s Reset
 * CSS file. Include this at the top of your filters list
 * and everything will reset.
 *
 * @author     Matt Kenefick
 * @company    Big Spaceship
 * @year       2009
 * @version    0.0.1
 * @url        http://www.bigspaceship.com
 */

 $filter          = new stdClass;
 $filter->name    = 'Reset';


 /**
  * Collect Assets
  */
 $reset   = file_get_contents(
                  "$filePath/../filters/" .
                  "{$filter->name}/assets/" .
                  "skin/Reset.css"
            );



 /**
  * Change Our Output
  */
 $output  = $reset . $output;
