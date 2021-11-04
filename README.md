# TrungOrderComment

# Changelog
    * 1.0.0 - Add Order Comment by message queue

# Config 
    Store -> Configuration -> Sales -> Sales -> General -> Enable Update Order Comment
    Store -> Configuration -> Sales -> Sales -> General -> Order Comment
    ![img.png](img.png)
# Run queue manually 
    bin/magento queue:consumers:start order.comment
   
