package com.example.demo.model;

import java.util.ArrayList;
import java.util.List;

public class CartInfo {

	private int orderNum;

	private CustomerInfo customerInfo;
	
	private int amountTotal;
	
	private final List<CartLineInfo> cartLines = new ArrayList<CartLineInfo>();

	public CartInfo() {
		this.amountTotal = 0;
		this.customerInfo = new CustomerInfo();
	}

	public int getOrderNum() {
		return orderNum;
	}

	public void setOrderNum(int orderNum) {
		this.orderNum = orderNum;
	}

	public CustomerInfo getCustomerInfo() {
		return customerInfo;
	}

	public void setCustomerInfo(CustomerInfo customerInfo) {
		this.customerInfo = customerInfo;
	}

	public List<CartLineInfo> getCartLines() {
		return this.cartLines;
	}

	public CartLineInfo findLineByCode(String code) {
		for (CartLineInfo line : this.cartLines) {
			if (line.getProductInfo().getCode().equals(code)) {
				return line;
			}
		}
		return null;
	}

	public void addProduct(ProductInfo productInfo) {
		CartLineInfo line = this.findLineByCode(productInfo.getCode());

		if (line == null) {
			line = new CartLineInfo();
			line.setQuantity(1);
			line.setMaxNumberOfProduct(productInfo.getMaxNumberProduct());
			line.setProductInfo(productInfo);
			this.cartLines.add(line);
		}
	}
	
	public void addProduct(ProductDetailInfo productDetail) {
		CartLineInfo line = this.findLineByCode(productDetail.getCode());
		ProductInfo productInfo = new ProductInfo(productDetail);
		if (line == null) {
			line = new CartLineInfo();
			line.setQuantity(1);
			line.setMaxNumberOfProduct(productInfo.getMaxNumberProduct());
			line.setProductInfo(productInfo);
			this.cartLines.add(line);
		}
	}
	
	public void addProduct(ProductInfo productInfo, int quantity) {
		CartLineInfo line = this.findLineByCode(productInfo.getCode());

		if (line == null) {
			line = new CartLineInfo();
			line.setQuantity(0);
			line.setProductInfo(productInfo);
			this.cartLines.add(line);
		}
		int newQuantity = line.getQuantity() + quantity;
		if (newQuantity <= 0) {
			this.cartLines.remove(line);
		} else {
			line.setQuantity(newQuantity);
		}
	}
	
	public void validate() {

	}

	public void updateProduct(String code, int quantity) {
		CartLineInfo line = this.findLineByCode(code);

		if (line != null) {
			if (quantity <= 0) {
				this.cartLines.remove(line);
			} else {
				line.setQuantity(quantity);
			}
		}
	}
	
	public void updateProduct(String code) {
		CartLineInfo line = this.findLineByCode(code);

		if (line != null) {
			if (line.getQuantity() <= 0) {
				this.cartLines.remove(line);
			} else {
				line.setQuantity(line.getQuantity() + 1);
			}
		}
	}

	public void removeProduct(ProductInfo productInfo) {
		CartLineInfo line = this.findLineByCode(productInfo.getCode());
		if (line != null) {
			this.cartLines.remove(line);
		}
	}

	public boolean isEmpty() {
		return this.cartLines.isEmpty();
	}

	public boolean isValidCustomer() {
		return this.customerInfo != null && this.customerInfo.isValid();
	}

	public int getQuantityTotal() {
		int quantity = 0;
		for (CartLineInfo line : this.cartLines) {
			quantity += line.getQuantity();
		}
		return quantity;
	}

	public int getAmountTotal() {
		int total = 0;
		for (CartLineInfo line : this.cartLines) {
			total += line.getAmount();
		}
		this.amountTotal = total;
		return amountTotal;
	}

	public void updateQuantity(CartInfo cartForm) {
		if (cartForm != null) {
			List<CartLineInfo> lines = cartForm.getCartLines();
			for (CartLineInfo line : lines) {
				this.updateProduct(line.getProductInfo().getCode(), line.getQuantity());
			}
		}
	}

	public boolean isExitsProduct(String code) {
		for (CartLineInfo info : this.cartLines) {
			if (info.getProductInfo().getCode().equals(code)) {
				return true;
			}
		}
		return false;
	}

	public void setAmountTotal(int amountTotal) {
		this.amountTotal = amountTotal;
	}
}
