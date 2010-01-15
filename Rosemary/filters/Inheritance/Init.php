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
 * Inheritance
 * Lets you separate but inherit properties from other selectors
 *
 * To do:
 *     - Multiple inheritance separated by comma
 *
 * Known Issues:
 *     - If you try to inherit a parent that doesn't exist,
 *       it will just duplicate its own variables in itself.
 *     - Multiple inheritance takes last used parent
 *
 * Usage:
 *     // Can use [+property] or [property+]
 *     myDiv { color: blue; }
 *     p[+myDiv] { background: white; }
 *
 * Result:
 *     myDiv { color: blue; }
 *     p { color: blue; background: white; }
 *
 * @author     Matt Kenefick
 * @company    Big Spaceship
 * @year       2009
 * @version    0.0.1
 * @url        http://www.bigspaceship.com
 */

 $filter          = new stdClass;
 $filter->name    = 'Inheritance';

 $filter->options = array();
 $filter->options['useNotes']   = false;

 preg_match_all( "/[a-z0-9\-\_]+ ?\[\+?([^\]\+]+)\+?\]/im", $output, $requests );
 foreach( $requests[0] as $k => $v ){
    /**
     * Get Our Target
     *
     * Inheriter[0] full item
     * Inheriter[1] full selector
     * Inheritor[2] full body
     */
    $v = str_replace(array('[',']','+'),array('\[','\]','\+'),$v);
    preg_match( "/($v)(.*?)\{([^}]+)\}/im", $output, $inheriter);

    // get object to inherit
    $v2 = str_replace(array('[',']','+'),array('\[','\]','\+'),$requests[1][$k]);
    preg_match( "/($v2).*?[^,\{]{0,}\{([^}]+)\}/im", $output, $inheritee);

    /**
     * Optional note
     */
    if( $filter->options['useNotes'] ){
      $noteStart   = "\n/*-------------*/\n";
      $noteEnd     = "\n/*------ Inherited from: $v2 */\n";
    }else{
      $noteStart = $noteEnd = '';
    }

    if( strpos( $inheriter[1], '[+' ) ){
      // frontal replacement
      $inheriter[4]   = $noteStart . $inheritee[2] . $noteEnd . $inheriter[3];
    }else{
      // rear replacement
      $inheriter[4]   = $inheriter[3] . $noteStart . $inheritee[2] . $noteEnd;
    }

    $inheriter['final']   = str_replace( $inheriter[3], $inheriter[4], $inheriter[0] );
    $output               = str_replace( $inheriter[0], $inheriter['final'], $output );
 }

 // clear out selectors
 $output    = preg_replace("/\[\+?.*?\+?\]/im",'',$output);
