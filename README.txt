Hello sir! Below is a sequential list of how to view the files we have submitted: 
1. Ensure that Wampserver and MySQL Workbench is installed in the computer to be used.
2. Turn on Wampserver.
3. Open MySQL Workbench then create a schema named epon, double click epon so that it is the schema that will be used then execute the peerpal.sql sql file inside the submitted folder.
4. After properly setting up the database, go to the C: drive in your computer then find the folder wamp64, open it then go to www. Inside www, copy the whole folder named SLUOnlineEvaluation. The address should then be C:\wamp64\www\SLUOnlineEvaluation.
5. Open any browser in the computer being used then type localhost/SLUOnlineEvaluation to enter the website and start using it.
OR
6. You may edit the httpd-vhost.conf file and insert the following then save it and restart the server:
<VirtualHost *:80>
  ServerName www.sluonlineevaluation.com
  ServerAlias sluonlineevaluation.com
  DocumentRoot "${INSTALL_DIR}/www/SLUOnlineEvaluation"
  <Directory "${INSTALL_DIR}/www/SLUOnlineEvaluation">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require all granted
  </Directory>
7. Edit the hosts file and insert:
127.0.0.1 www.sluonlineevaluation.com

You may login as the instructor using:
username: 2165500 
password: admin

You may also sign-up for an account by clicking Log In > Sign Up

You may also login as a student:
username: 2160316 
password: password