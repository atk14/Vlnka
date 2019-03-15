Vlnka
=====

Replaces regular space with a non-breaking space in places where line break should not occur as per Czech language spec.

Actually Vlnka provides a Smarty block helper and modifier for usage in an application which uses [Smarty](http://www.smarty.net/) as the template engine.

In an ATK14 application Vlnka takes effect only when Czech or Slovak language is used.

Basic usage
-----------

In a template:

    {* block helper usage *}
    {vlnka}
      <p>
        Here is the text in which all the regular spaces will be replaced with non-breaking spaces.
      </p>
      <p>
        Zde je text, ve kterém budou na všech potřebných místech nahrazeny normální mezery mezerami nedělitelnými.
      </p>
      <p title="titulek v HTML tagu zůstane zachován beze změny">
        Vlnka doesn't change content of HTML tags.
      </p>
    {/vlnka}

    {* modifier usage *}
    {$text|vlnka}

Installation
------------

Just use the Composer:

    cd path/to/your/atk14/project/
    composer require atk14/vlnka

License
-------

Vlnka is free software distributed [under the terms of the MIT license](http://www.opensource.org/licenses/mit-license)

[//]: # ( vim: set ts=2 et: )
