package com.example.demo.service.impl;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.UUID;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.Order;
import com.example.demo.entity.OrderDetail;
import com.example.demo.entity.Product;
import com.example.demo.model.CartInfo;
import com.example.demo.model.CartLineInfo;
import com.example.demo.model.CustomerInfo;
import com.example.demo.model.OrderDetailInfo;
import com.example.demo.model.OrderInfo;
import com.example.demo.model.PaginationResult;
import com.example.demo.reponsitory.OrderDetailRepository;
import com.example.demo.reponsitory.OrderRepository;
import com.example.demo.service.OrderService;
import com.example.demo.service.ProductService;

@Service
public class OrderServiceImpl implements OrderService {

	@Autowired
	private OrderRepository orderRepository;

	@Autowired
	private ProductService productService;

	@Autowired
	private OrderDetailRepository orderDetailRepository;

	private int getMaxOrderNum() {
		List<Order> listOrder = (List<Order>) orderRepository.findAll();
		int max = 0;
		for (Order order : listOrder) {
			if (order.getOrderNum() > max) {
				max = order.getOrderNum();
			}
		}
		return max;
	}

	@Override
	public void saveOrder(CartInfo cartInfo) {
		int orderNum = getMaxOrderNum() + 1;

		Order order = new Order();

		order.setId(UUID.randomUUID().toString());
		order.setOrderNum(orderNum);
		order.setOrderDate(new Date());
		order.setAmount(cartInfo.getAmountTotal());

		CustomerInfo customerInfo = cartInfo.getCustomerInfo();
		order.setCustomerName(customerInfo.getName());
		order.setCustomerEmail(customerInfo.getEmail());
		order.setCustomerPhone(customerInfo.getPhone());
		order.setCustomerAddress(customerInfo.getAddress());

		orderRepository.save(order);

		List<CartLineInfo> lines = cartInfo.getCartLines();

		for (CartLineInfo line : lines) {
			OrderDetail detail = new OrderDetail();
			detail.setId(UUID.randomUUID().toString());
			detail.setOrder(order);
			detail.setAmount(line.getAmount());
			detail.setPrice(line.getProductInfo().getPrice());
			detail.setQuanity(line.getQuantity());

			String code = line.getProductInfo().getCode();
			Product product = productService.findProduct(code);
			detail.setProduct(product);

			orderDetailRepository.save(detail);
		}

		// Set OrderNum for report.
		// Set OrderNum để thông báo cho người dùng.
		cartInfo.setOrderNum(orderNum);
	}

	// @page = 1, 2, ...
	@Override
	public PaginationResult<OrderInfo> listOrderInfo(int page, int maxResult, int maxNavigationPage) {
		return null;
	}

	@Override
	public OrderInfo getOrderInfo(String orderId) {
		List<Order> listOrder = (List<Order>) orderRepository.findAll();
		for (Order order : listOrder){
			if (order.getId().equals(orderId)){
				return new OrderInfo(order);
			}
		}
		return null;
	}

	@Override
	public List<OrderDetailInfo> listOrderDetailInfos(String orderId) {
		List<OrderDetail> listOrderDetail = (List<OrderDetail>) orderDetailRepository.findAll();
		List<OrderDetailInfo> listOrderDetailInfo = new ArrayList<OrderDetailInfo>();
		for (OrderDetail orderDetail : listOrderDetail){
			OrderDetailInfo orderDetailInfo = new OrderDetailInfo(orderDetail);
			listOrderDetailInfo.add(orderDetailInfo);
		}
		return listOrderDetailInfo;
	}

}
