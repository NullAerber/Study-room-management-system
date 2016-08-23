http://jingyan.baidu.com/article/2d5afd69efe9cf85a3e28e54.html
wampserver的安装说明

tms 是数据库的名字

userinfo 用户数据表
   log_state  登录状态
   seat_state 占座状态
   id         序号
   username   用户名
   password   密码，密码和用户名相同

seatone  自习室一表
   id         序号
   user       占座的用户名字
   startdate  占座的开始时间
   enddate    占座结束的时间

seattwo  自习室二表
   同自习室一表


自习室的刷新需要刷新两次，第一次无法更新，第二次才可以