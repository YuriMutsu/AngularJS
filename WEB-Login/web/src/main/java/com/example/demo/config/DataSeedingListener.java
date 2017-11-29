package com.example.demo.config;

import com.example.demo.entity.Accounts;
import com.example.demo.service.AccountService;

import java.util.Date;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.ApplicationListener;
import org.springframework.context.event.ContextRefreshedEvent;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Component;

import static com.example.demo.contants.UserConstants.*;
@Component
public class DataSeedingListener implements ApplicationListener<ContextRefreshedEvent> {

    @Autowired
    private AccountService userService;

    @Autowired
    private PasswordEncoder passwordEncoder;

    @SuppressWarnings("deprecation")
	@Override
    public void onApplicationEvent(ContextRefreshedEvent arg0) {

        // Admin account
        if (userService.findAccount("admin") == null) {
        	Accounts admin = new Accounts();
            admin.setUserName("admin");
            admin.setPassword(passwordEncoder.encode("123456"));
            admin.setEmail("admin@gmail.com");
            admin.setBirthday(new Date("04/09/1995"));
            admin.setAddress("TP. HCM");
            admin.setPhone("0898133817");
            admin.setFirstName(("Administrator"));
            admin.setLastName("Yuri");
            admin.setGender("Male");
            admin.setActive(true);
            admin.setUserRole(ROLE_ADMIN);
            userService.save(admin);
        }

        // Member account
        if (userService.findAccount("member") == null) {
        	Accounts member = new Accounts();
            member.setUserName("member");
            member.setPassword(passwordEncoder.encode("123456"));
            member.setEmail("member@gmail.com");
            member.setBirthday(new Date("04/09/1995"));
            member.setAddress("TP. HCM");
            member.setPhone("0898133817");
            member.setFirstName("Member");
            member.setGender("Male");
            member.setLastName("Yuri");
            member.setActive(true);
            member.setUserRole(ROLE_MEMBER);
            userService.save(member);
        }
    }

}
