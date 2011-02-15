 ----------
  Rosemary
 ----------

 @author  Matt Kenefick
 @company Big Spaceship
 @year    2009
 @version 0.0.1
 
 @title   Mixins
 
 This is the start of a mimic version for what others call "Mix-ins."
 It allows you to create variable blocks. This port into Rosemary allows 
 you to use any type of selector. It also groups them from everywhere 
 they're found. This filter is a intended to be a demonstration of 
 Rosemary's versatility in low-level ability.
 
 Example: ---------------------------
 
 body, #myDiv{ width: 500px; }
 #myDiv{ color: red; }
 strong{
     body;
 }
 p{
     #myDiv;
     font-weight: normal;
 }

 Result: ----------------------------
 
 body, #myDiv{ width: 500px; }
 #myDiv{ color: red; }
 strong{
     width: 500px;
 }
 p{
     width: 500px;
     color: red;
     font-weight: normal;
 }
 
 Notes: -----------------------------
 
 There are some outstanding issues involving things like properties 
 broken across multiple lines may be thought of as selectors. Some
 unknown issues may occur when combined with other filters.
 
 This is an initial mockup for how this might work. Not a complete
 product. Feel free to improve upon this filter. 
 
 ----------------------------------------------------------------------------------
 ----------------------------------------------------------------------------------
