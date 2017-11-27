package com.example.demo.reponsitory;

import org.springframework.data.repository.CrudRepository;

import com.example.demo.entity.Account;

public interface AccountRepository extends CrudRepository<Account, Integer>{

}
