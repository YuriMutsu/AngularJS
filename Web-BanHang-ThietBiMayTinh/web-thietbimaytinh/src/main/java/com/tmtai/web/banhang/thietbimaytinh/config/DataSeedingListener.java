package com.tmtai.web.banhang.thietbimaytinh.config;

import com.tmtai.web.banhang.thietbimaytinh.entity.Users;
import com.tmtai.web.banhang.thietbimaytinh.service.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.ApplicationListener;
import org.springframework.context.event.ContextRefreshedEvent;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Component;

@Component
public class DataSeedingListener implements ApplicationListener<ContextRefreshedEvent> {

    @Autowired
    private UserService userService;

    @Autowired
    private PasswordEncoder passwordEncoder;

    @Override
    public void onApplicationEvent(ContextRefreshedEvent arg0) {

        // Admin account
        if (userService.findByUsername("admin") == null) {
            Users admin = new Users();
            admin.setUsername("admin");
            admin.setPassword(passwordEncoder.encode("123456"));
            admin.setEmail("admin@gmail.com");
            admin.setBirthday("04/09/1995");
            admin.setAddress("TP. HCM");
            admin.setPhone("0898133817");
            admin.setFristname("Administrator");
            admin.setLastname("Yuri");
            admin.setGender("Male");
            admin.setEnable(1);
            admin.setRole("ROLE_ADMIN");
            userService.save(admin);
        }

        // Member account
        if (userService.findByUsername("member") == null) {
            Users member = new Users();
            member.setUsername("member");
            member.setPassword(passwordEncoder.encode("123456"));
            member.setEmail("member@gmail.com");
            member.setBirthday("04/09/1995");
            member.setAddress("TP. HCM");
            member.setPhone("0898133817");
            member.setFristname("Member");
            member.setGender("Male");
            member.setLastname("Yuri");
            member.setEnable(1);
            member.setRole("ROLE_MEMBER");
            userService.save(member);
        }
    }

}
