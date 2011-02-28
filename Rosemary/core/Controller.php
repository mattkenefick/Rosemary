<?php
/**
 * Rosemary Controller by Big Spaceship. 2009
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

  header( 'Content-Type: text/css' );

    // get files
  $docRoot      =  $_SERVER['DOCUMENT_ROOT'];
  $ruri         =   current(explode('?', $_SERVER['REQUEST_URI']));
  $filePath     =  substr(
                      $_SERVER['SCRIPT_NAME'],
                      0,
                      strrpos($_SERVER['SCRIPT_NAME'],'/')
                   );
  $filePath     =  $docRoot . $filePath;
  $rosemary     =  preg_replace( '/\.css$/im', '.rosemary', $ruri );
  $output       =  file_get_contents( $docRoot.$ruri );

    $useModifiers   =   @current($_GET);

    if( file_exists( $docRoot.$rosemary ) || $useModifiers ){
        if($useModifiers){
            include $docRoot . $useModifiers;
        }else
            include $docRoot.$rosemary;
    }else{
        die( '/** failure (no rosemary file ' . $docRoot.$rosemary . ' ) **/ '. $output );
    };


  foreach( $modifiers as $modifier )
    if( file_exists("$filePath/../filters/$modifier/Init.php") )
      include "$filePath/../filters/$modifier/Init.php";

  die( $output );
