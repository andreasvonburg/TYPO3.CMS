========================================================================
Breaking: #77453 - Signature of AbstractPlugin::pi_list_makelist changed
========================================================================

Description
===========

The expected result data type of the method :php:``AbstractPlugin::pi_list_makelist`` has been changed.

Instead of accepting :php:``bool``, :php:``\mysqli_result`` or :php:``object`` as a
result provider only :php:``\Doctrine\DBAL\Driver\Statement`` objects are accepted.


Impact
======

3rd party extensions using :php:``AbstractPlugin::pi_list_makelist`` need to provide the correct
input type.


Affected Installations
======================

Installations using 3rd party extensions that use :php:``AbstractPlugin::pi_list_makelist``.


Migration
=========

Migrate all code that works with the :php:``AbstractPlugin::pi_list_makelist`` to provide the expected
Doctrine Statement object.
