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
 * Browser
 * Plugin allows condition blocks and properties dependant
 * on browsers. Can use names like: ie6, ie, ie7, etc...
 * and also use compatibility like gecko, webkit, etc
 *
 * To do:
 *     - Multiple selectors
 *     - Clean up code
 *
 * Usage:
 *     ~ie myDiv{ color: blue; }
 *     ~!ie myDiv{ background: black; }
 *     ~firefox,ie,safari { ~ie color: blue; ~firefox: color: red; }
 *
 * @author     Matt Kenefick
 * @company    Big Spaceship
 * @year       2009
 * @version    0.0.1
 * @url        http://www.bigspaceship.com
 **/

 $filter          = new stdClass;
 $filter->name    = 'Browser';

 $browsers        = array(
        'ie6'       =>  'MSIE 6.',
        'ie7'       =>  'MSIE 7.',
        'ie8'       =>  'MSIE 8.',
        'ie'        =>  'MSIE',
        'firefox'   =>  'firefox',
        'firefox2'  =>  'firefox\/2',
        'firefox3'  =>  'firefox\/3',
        'firefox35' =>  'firefox\/3.5',
        'safari'    =>  'safari',
        'safari2'   =>  '2\.[^s]+safari',
        'safari3'   =>  '3\.[^s]+safari',
        'safari4'   =>  '4\.[^s]+safari',
        'opera'     =>  'opera',
        'opera8'    =>  'opera\/8.',
        'opera9'    =>  'opera\/9.',
        'opera10'   =>  'opera\/10.',
        'chrome'    =>  'chrome',
        'chrome2'   =>  'chrome\/2.',
        'chrome3'   =>  'chrome\/3.',
        'chrome4'   =>  'chrome\/4.',
        'webkit'    =>  'webkit',
        'gecko'     =>  'gecko\/[0-9]'
 );

  // get blocks
 preg_match_all( "/(~\!?)([^ ]+)(.*?)\{([^}]+)\}/im", $output, $requests );

 foreach( $requests[0] as $k => $v ){
    $found            = 0;
    $requestBrowsers  = explode( ',', $requests[2][$k] );

    foreach( $requestBrowsers as $reqBrowser ){
      if( strpos($requests[1][$k],'!') > -1 ){
        // when checking AGAINST browsers
        // ~!ie,firefox,etc
        if( !preg_match(
              '/'.$browsers[$reqBrowser].'/im',
              strtolower($_SERVER['HTTP_USER_AGENT']))
        )
        $found++;
      }else{
        // when checking FOR browsers
        // ~ie,firefox,etc
        if( preg_match(
              '/'.$browsers[$reqBrowser].'/im',
              strtolower($_SERVER['HTTP_USER_AGENT']))
        )
        $found++;
      }
    }
    if(!$found){
      $output = str_replace( $v, '', $output );
    }
 }


  // get properties
 preg_match_all( "/(~\!?)([^ ]+)(.*?)\:([^;]+)\;/im", $output, $requests );
 foreach( $requests[0] as $k => $v ){
    $found            = 0;
    $requestBrowsers  = explode( ',', $requests[2][$k] );

    foreach( $requestBrowsers as $reqBrowser ){
      if( strpos($requests[1][$k],'!') > -1 ){
        // when checking AGAINST browsers
        // ~!ie,firefox,etc
        if( !preg_match(
              '/'.$browsers[$reqBrowser].'/im',
              strtolower($_SERVER['HTTP_USER_AGENT']))
        )
        $found++;
        if( !$found )
          $output = str_replace( $v, '', $output );
      }else{
        // when checking FOR browsers
        // ~ie,firefox,etc
        if( preg_match(
              '/'.$browsers[$reqBrowser].'/im',
              strtolower($_SERVER['HTTP_USER_AGENT']))
        )
        $found++;
        if( !$found){
          $output = str_replace( $v, '', $output );
        }
      }
    }
 }

 // clean up syntax
 $output    = preg_replace('/~[^ ]+/','',$output);

