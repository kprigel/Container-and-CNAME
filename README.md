Container-and-CNAME
===================

Quick function that creates a container on Rackspace Cloud Files (Openstack Object Storage) and creates a CNAME entry for an existing domain name in Rackspace Cloud DNS.



This function was created in order to add containers to Rackspace Cloud Files, publish the container to the CDN, get the public URL for the CDN, and add a CNAME record to an existing domain managed with Rackspace Cloud DNS.

As this is a first version of the function, there is no error checking.  Only call the function with a valid container name that does not exist, and specify a valid domain that exists in your Rackspace Cloud DNS.  

The function is relatively simple, for example, ContAndCNAME("TestContainer","MyDomain.com") would create a container named TestContainer, and a CNAME testcontainer.mydomain.com pointing to the public CDN URL for the new container.

This function required installation of Rackspace's php-opencloud library.
