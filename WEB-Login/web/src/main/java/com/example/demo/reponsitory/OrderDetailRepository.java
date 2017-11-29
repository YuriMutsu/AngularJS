package com.example.demo.reponsitory;

import org.springframework.data.repository.CrudRepository;

import com.example.demo.entity.OrderDetails;

public interface OrderDetailRepository extends CrudRepository<OrderDetails, Integer>{

}
