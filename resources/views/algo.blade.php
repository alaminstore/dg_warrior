Referal tier system complete algorith by shakibul islam:

This table is only for tracking who is whos referal

(1) create a table with name 'referals_tracking' 
(2)Create three columns with name  ('id','user' and 'refered_user')  where 'user' and 'refered_user' would be ForeignKey of User table
(3)Just store the data the user and invited referal user to the column ('user' and 'refered_user') everytime when a new user is registered with someone referal just store it no logic.


programming logic:

	(1)Select the logged in user
	(2)Search on 'referal_tracking' database table how many  referal entry with this user and store at an array .
	(3)Run a for loop and loop through every found by search 'refered user' . (tier 2 refered user ids)
	(4)Now Search again in the 'referal tracking' table but now you will search this 'refered user' id at the 'user' column and put the 


	new 'refered  user'  ids into an array. and count this array.



You found tier 1 referals of the user at the first search and got tier two referal at the second search and count them.

Now implement 5,2 or 10,4 logic to it.


1.If total count of tier 1 referal of the logged in user is 5 and tier 2 count is 2 unlock 1 (HR) task.
2.If total count of tier 1 referal of the logged in user is 10 and tier 2 count is 3 unlock 1 (HR) task.


The problem is you need to keep track of how many tasks has been already unlocked. Thats why you can use different table to track per user.

You will finally unlock the offer (total unlock offer value from seaarching at db -  total unlocked already) = result would be your final current unlock number.