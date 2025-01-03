Roles:

Admin
Customer


Tables:


users ->(id,name,password,number,address,image,role)
category ->(id,name,status)
products ->(id,name,desc,price,qty,image,status)

cart ->(id,userid,prodid,qty)
orders->(id,userid,prodid,qty,address2,payment_method,status)
contact ->(id,name,email,number,message)