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
 * Variables
 * Allows you to add variables to your CSS
 *
 * Notes:
 *    This filter leaves a lot of whitespace due to
 *    variable definitions. Best used with the whitespace
 *    filter.
 *
 * @author     Matt Kenefick
 * @company    Big Spaceship
 * @year       2009
 * @version    0.0.1
 * @url        http://www.bigspaceship.com
 */

 $filter          = new stdClass;
 $filter->name    = 'Variables';

 $globalIdentifier  = 'define\sglobal\svariables';
 $search            = array();
 $replace           = array();

 /**
  * Change Our Output
  */
 preg_match_all("/define (.*?)\:(.*?)\;/im", $output, $variableBlock);
 $defines     = array_reverse($variableBlock[0]);
 $search      = array_reverse($variableBlock[1]);
 $replace     = array_reverse($variableBlock[2]);
 $tmpOutput   = $output;

 // set var keys
 foreach( $search as $k => $v ){
  $var          = '@'. $v;
  $offsetA      = strpos( $output, $defines[$k] );
  $tmpOutput    = str_replace( $var, $replace[$k], $output );
  $offsetB      = strpos( $tmpOutput, $defines[$k] );

  $replaced     = substr( $tmpOutput, $offsetB , strlen( $tmpOutput) );
  $output       = substr( $output, 0, $offsetA ) . $replaced;
 }

 // remove vars
 $output      = str_replace( $defines, '', $output );

