package com.example.demo.validator;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.validation.Errors;
import org.springframework.validation.ValidationUtils;
import org.springframework.validation.Validator;

import com.example.demo.entity.Products;
import com.example.demo.model.ProductInfo;
import com.example.demo.service.ProductService;

// Khai báo là một @Component (Nghĩa là 1 Bean).
@Component
public class ProductInfoValidator implements Validator {

	@Autowired
	private ProductService productService;

	// Validator này chỉ dùng để kiểm tra class ProductInfo.
	@Override
	public boolean supports(Class<?> clazz) {
		return clazz == ProductInfo.class;
	}

	@Override
	public void validate(Object target, Errors errors) {
		ProductInfo productInfo = (ProductInfo) target;

		// Kiểm tra các trường (field) của ProductInfo.
		ValidationUtils.rejectIfEmptyOrWhitespace(errors, "code", "NotEmpty.productForm.code");
		ValidationUtils.rejectIfEmptyOrWhitespace(errors, "name", "NotEmpty.productForm.name");
		ValidationUtils.rejectIfEmptyOrWhitespace(errors, "price", "NotEmpty.productForm.price");

		String code = productInfo.getCode();
		if (code != null && code.length() > 0) {
			if (code.matches("\\s+")) {
				errors.rejectValue("code", "Pattern.productForm.code");
			} else if (productInfo.isNewProduct()) {
				Products product = productService.findProduct(code);
				if (product != null) {
					errors.rejectValue("code", "Duplicate.productForm.code");
				}
			}
		}
	}

}
