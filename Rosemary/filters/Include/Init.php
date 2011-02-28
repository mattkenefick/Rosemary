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
 * Include
 * Allows you to include multiple files to your CSS.
 * You can include the files either completely raw
 * and let it follow the same processing as this Rosemary
 * file, or you can let it have its own processing on top
 * of this files.
 *
 * Usage:
 *  body{
 *     height: 100%;
 *  }
 *
 *  include ./myRawFile.css -raw;
 *  include ./myProcessedFile.css;
 *
 *
 * @author     Matt Kenefick
 * @company    Big Spaceship
 * @year       2009
 * @version    0.0.1
 * @url        http://www.bigspaceship.com
 */


 $filter          = new stdClass;
 $filter->name    = 'Include';

 // $rosemary comes from the controller
 $domain        =  parse_url($_SERVER['SCRIPT_URI']);

 $cssPath       =  substr(
                      $rosemary,
                      0,
                      strrpos($rosemary,'/')
                   );
 $cssFilePath   =  $docRoot . $cssPath;
 $cssWebPath    =  $domain['scheme'] . '://' . $domain['host'] . '/' . $cssPath;

 /**
  * Change Our Output
  */
 preg_match_all("/include (.*?)( -raw| -inherit)?\;/im", $output, $variableBlock);
 $defines       =  array_reverse($variableBlock[0]);
 $file          =  array_reverse($variableBlock[1]);
 $isRaw         =  array_reverse($variableBlock[2]);
 $tmpOutput     =  $output;

 // set var keys
 foreach( $file as $k => $v ){
    if( @$isRaw[0] == ' -raw' ){
        $cssFile    =   file_get_contents( $cssFilePath . '/' . $v );
    }else if(@$isRaw[0] == ' -inherit'){
        $cssFile    =   file_get_contents( $cssWebPath . '/' . $v . '?useModifiers=' . (!@empty($useModifiers)?$useModifiers : $rosemary) );
    }else{
        $cssFile    =   file_get_contents( $cssWebPath . '/' . $v );
    }

    $output    =   str_replace( $defines[$k], $cssFile, $output );
 }
