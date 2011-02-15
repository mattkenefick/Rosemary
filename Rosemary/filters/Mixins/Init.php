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
 * Mixins
 * Lets you separate but inherit properties from other selectors in
 * a similar to other CSS enhancers.
 *
 * To-Do:
 *    - More extensive error checking
 *    - More accurate block search
 *
 * @author     Matt Kenefick
 * @company    Big Spaceship
 * @year       2009
 * @version    0.0.1
 * @url        http://www.bigspaceship.com
 */

 $filter          = new stdClass;
 $filter->name    = 'Mixins';

/**
 * Fix to account for properties like:
 * width:
 *  200px;
 */
    $output    =   str_replace(
                    array("{",";"),
                    array("{\n",";\n"),
                    $output
                );
                preg_match_all( "#
                                ^([a-zA-Z\t0-9\.\# \n]+)(?<!\:);$
                                #ixm",
                                $output,
                                $requests,
                                PREG_OFFSET_CAPTURE
                            );

    $length =   strlen( $output );

 foreach( $requests[1] as $k => $v ){
    $newLength =   strlen( $output );

    $tv     =   trim($v[0]);
    $tv     =   str_replace(
                        array('#','.'),
                        array('\#','\.'),
                        $tv
                    );

    preg_match_all( "%
                    {$tv}[^;{]*+{([^}]+)}
                     %ixm",
                     $output,
                     $tmp
                );

    $output =   substr_replace(
                        $output,
                        ($tmp[1][0])?implode('',$tmp[1]):'',
                        $newLength - ($length-$v[1]),
                        strlen($v[0])
                );
 }
