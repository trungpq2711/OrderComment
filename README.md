# TrungOrderComment

# Changelog
    * 1.0.0 - Add Order Comment by message queue

# Config 
    Store -> Configuration -> Sales -> Sales -> General -> Enable Update Order Comment
    Store -> Configuration -> Sales -> Sales -> General -> Order Comment
   ![img](https://user-images.githubusercontent.com/15412007/140307877-6f750688-22de-4430-961d-b93330e07cff.png)

# Run queue manually 
    bin/magento queue:consumers:start order.comment
   
