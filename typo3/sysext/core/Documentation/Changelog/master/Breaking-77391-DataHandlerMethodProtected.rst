===============================================
Breaking: #77391 - DataHandler method protected
===============================================

Description
===========

Method :php:`doesRecordExist_pageLookUp` of class :php:`DataHandler` has been changed from public access to protected and the returned object changed to an instance of :php:`QueryBuilder`.


Impact
======

Calling the method will trigger a fatal `PHP` error.


Affected Installations
======================

Extensions that use method :php:`doesRecordExist_pageLookUp`. This is very unlikely since the method is mostly only useful for core internal handling.


Migration
=========

No migration possible, remove method call.