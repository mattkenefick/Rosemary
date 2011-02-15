 ----------
  Rosemary
 ----------

 @author  Matt Kenefick
 @company Big Spaceship
 @year    2009
 @version 0.0.1
 
 @title   Include
 
 This filter allows you to include multiple other files into one
 single output. There are two ways this can be done:
 
     1.) File included in untouched format
     2.) File included after its own Rosemary processing
     
 This means your included file can be processed before being included
 in the document if it needs something the entire document doesn't.
 If you decide to include it raw, but it needs processing, make sure 
 your Include filter is toward the top of your Modifiers list.
 
 Syntax: ----------------------------
 
 include [filepath, [ -raw (optional)]];
 
 Example: ---------------------------
 
 #FILE included.css#
 * { font-size: 100px; }
 
 #FILE main.css#
 body{ height: 100%; }
 include ./included.css;

 Result: ----------------------------
 
 #FILE main.css#
 body{ height: 100%; }
 * { font-size: 100px; }
 
 Notes: -----------------------------
 
 This is an initial mockup for how this might work. Not a complete
 product. Feel free to improve upon this filter. 
 
 ----------------------------------------------------------------------------------
 ----------------------------------------------------------------------------------
