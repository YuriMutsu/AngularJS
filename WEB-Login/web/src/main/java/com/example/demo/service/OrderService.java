package com.example.demo.service;

import java.util.List;

import com.example.demo.model.CartInfo;
import com.example.demo.model.OrderDetailInfo;
import com.example.demo.model.OrderInfo;

public interface OrderService {
	public void saveOrder(CartInfo cartInfo);
	 
    public OrderInfo getOrderInfo(String orderId);
    
    public List<OrderDetailInfo> listOrderDetailInfos(String orderId);
}
