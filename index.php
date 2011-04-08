<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>CSS | Rosemary</title>
    <link href="css/main.css" rel="stylesheet" />
  </head>
  <body>

    <div id="main">
        <div id="introduction">
            <img src="./images/rosemary.png" alt="Rosemary" />
            <h1>(<a href="./css/main.txt" target="_blank">view css</a>)</h1>
            <p>
                Rosemary is an open-source modular cascading
                filter-based modification for CSS files. Anyone with some
                PHP skills under their belt has the
                ability to create filters to use with Rosemary. Combining
                filters in different arrangements will prove to offer
                diverse results. Developers and designers will both benefit
                from the ease of customization Rosemary provides. Filters
                can allow for deeply technical configurations or be simple
                as 1-2-3 Go!
            </p>

            <h2>Requirements</h2>
            <ul>
                <li>Apache</li>
                <li>PHP (some filters may require differing minimum versions)</li>
                <li>mod_rewrite enabled for PHP</li>
                <li>AllowOverride enabled in Apache</li>
                <li>Some filters may require use of `file_get_contents`</li>
            </ul>

            <h2>How it works</h2>
            <p>
                You setup an .htaccess file in your CSS directory. This
                rewrites all of your .css files through the filter. Each
                CSS file has a "*.rosemary" file associated with it which
                is where you define which filters you'd like to apply to
                this particular CSS. You can change the order and apply
                filters multiple times to acheive different effects (depending
                on the filter.)
            </p>
            <p>
                Filters are stored in the `Rosemary/filters/*` folder. The folder
                name for each filter must match the internal filter name. Meaning
                if you refer to a filter as "Inheritance" then the folder name
                must also be "Inheritance." Files are
                instantiated through the "Init.php" file of each filter. Follow
                the examples in the skeleton to create your own filters.
            </p>

            <h2>Setup</h2>
            <p>
                Just drop the prepackaged .htaccess file in your CSS folder and
                that's it. You'll be able to toggle your filters with each
                `*.rosemary` file. Make sure that you don't set your document
                root to be the `sandbox` folder because it won't be able to
                access the Rosemary core files one directory below.
            </p>

    <!-- ===============================================================
         TESTING
         ======================================================== -->
            <h2>Testing</h2>

            <div id="firefoxOnly">
                THIS BLOCK ONLY APPEARS IN FIREFOX
            </div>
            <div id="geckoOnly">
                THIS BLOCK ONLY APPEARS IN GECKO
            </div>
            <div id="safariOnly">
                THIS BLOCK ONLY APPEARS IN SAFARI
            </div>
            <div id="webkitOnly">
                THIS BLOCK ONLY APPEARS IN WEBKIT
                <span>
                THIS BLOCK APPEARS BOLD IN SAFARI ONLY (not chrome)
                </span>
            </div>

            <p id="colorTesting">
                <span>blue (blue)</span>
                <span>blue (red)</span>
                <span>big spaceship (bg grey)</span>
            </p>

            <div id="inheritanceTest">
                Inheritance test. #inheritanceTest
            </div>
            <div id="inheritanceTest2">
                Inheritance test showing an overwrite. #inheritanceTest2
            </div>

            <h2>Pre-packaged filters</h2>
            <p>
                Here's a little description of how each filter works.
            </p>

            <div id="filterDescriptions">

    <!-- ===============================================================
         RESET
         ======================================================== -->
                <h3>Yahoo! Reset</h3>
                <p class="details">
                    <strong>name:</strong> Reset
                    <br />
                    <strong>params:</strong> none
                </p>
                <p>
                    <strong>description:</strong> This is a standard issue Yahoo! Reset
                    CSS file that you can apply to your document. When you add this
                    filter, it automatically prepends the Reset CSS file to the top
                    of your document.
                </p>
                <br />

    <!-- ===============================================================
         VARIABLES
         ======================================================== -->
                <h3>Variables</h3>
                <p class="details">
                    <strong>name:</strong> Variables
                    <br />
                    <strong>params:</strong> none
                </p>
                <p>
                    <strong>description:</strong> Lets you setup variables to be applied
                    to your elements. Right now it is only supporting single variables as opposed
                    to blocks. If you need variable blocks, you can
                    use the `Inheritance` filter and apply your blocks that way. These variables
                    are cascading; meaning that you can define one at the top of your document,
                    use it, then overwrite it further down the document and have cascading changes.
                    Variable names accept anything except `:` (colons). They can have spaces, quotes,
                    underscores, etc.
                    <br />
                    <strong>usage:</strong>
            <pre>
                define red: #ff0000;
                define full wide: "600px";

                #myDiv {
                    /* Color will be red */
                    color: @red;
                    /* Width will be `"600px"` */
                    width: @full wide;
                }

                define red: #0000ff;

                #myDiv2{
                    /* Color will be blue */
                    color: @red;
                }
            </pre>
                </p>
                <br />

    <!-- ===============================================================
         BROWSER
         ======================================================== -->
                <h3>Browser</h3>
                <p class="details">
                    <strong>name:</strong> Browser
                    <br />
                    <strong>params:</strong> none
                </p>
                <p>
                    <strong>description:</strong>
                    Lets the user set optional parameters to CSS blocks AND parameters
                    that are dependant on the visitor's browser type. Acceptable values
                    currently are: <em>ie, ie6, ie7, ie8, firefox, firefox2, firefox3,
                    firefox35, safari, safari2, safari3, safari4, opera, opera8, opera9,
                    opera10, chrome, chrome2, chrome3, chrome4, gecko, webkit</em>. You can
                    set these values to be "Only if
                    user is using X browser," "Only if user is NOT using X browser," and
                    also make grouped selections.
                    <br />
                    <strong>usage:</strong>
            <pre>
                ~ie #myDiv{
                    /** This block only appears for IE browsers **/
                }

                ~!ie #myDiv{
                    /** This block only appears for NON-IE browsers **/
                }

                ~gecko #myDiv{
                    /** This block only appears for Gecko-type browsers **/
                }

                #myDiv{
                    /** Can be applied to properties inside blocks **/
                    ~ie height: 100%;
                    ~!ie height: 500px;
                }

                /** Coming soon **/
                ~ie7,ie8 #myDiv{
                    /** This block only appears for IE7+8 browsers **/
                    /** Multiple selections CANNOT have whitespace between commas **/
                }
            </pre>
                </p>
                <br />

    <!-- ===============================================================
         INHERITANCE
         ======================================================== -->
                <h3>Inheritance</h3>
                <p class="details">
                    <strong>name:</strong> Inheritance
                    <br />
                    <strong>params:</strong> none yet
                </p>
                <p>
                    <strong>description:</strong>
                    This filter allows you to inherit properties from another block
                    without having to put it in the comma delimited selectors group.
                    You have the option of prepending or appending it to your block.
                    <br />
                    <strong>usage:</strong>
            <pre>
                .clearFix{
                    content: ".";
                    display: block;
                    clear: both;
                    visibility: hidden;
                    line-height: 0;
                    height: 0;
                }

                /** Code that makes separation awkward... **/

                .needsClearing:after[+.clearFix]{
                    /** clearfix code gets put HERE **/
                    color: red;
                }

                .needsClearing:after[.clearFix+]{
                    content: "...";
                    /** clearfix code gets put HERE, content is overridden **/
                }
            </pre>
                </p>
                <br />

    <!-- ===============================================================
         STRIP COMMENTS
         ======================================================== -->
                <h3>StripComments</h3>
                <p class="details">
                    <strong>name:</strong> StripComments
                    <br />
                    <strong>params:</strong> none
                </p>
                <p>
                    <strong>description:</strong>
                    Strips out all comment blocks from CSS.
                </p>
                <br />

    <!-- ===============================================================
         COMPRESSOR
         ======================================================== -->
                <h3>Compressor</h3>
                <p class="details">
                    <strong>name:</strong> Compressor
                    <br />
                    <strong>params:</strong> none
                </p>
                <p>
                    <strong>description:</strong>
                    Removes whitespace and line breaks. Make sure to end all
                    of your lines with semi-colons or you'll get errors.
                </p>
                <br />

            </div>

        </div>
    </div>

  </body>
</html>
