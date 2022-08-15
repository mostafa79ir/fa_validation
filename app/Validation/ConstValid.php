<?php namespace App\Validation;

    class ConstValid{ 

        const NAME_EMP_ERR = "فیلد نام نمی تواند خالی باشد";
        const NAME_LET_ERR = "فیلد نام بایستی  تنها از حروف انگلیسی و بدون فاصله باشد";
        const NAME_MIN_ERR = "فیلد نام بایستی بیشتر از 3 حرف داشته باشد";
        const USERNAME_EMP_ERR = "فیلد نام کاربری نمی تواند خالی باشد";
        const USERNAME_NUMLET_ERR = "فیلد نام کاربری می تواند از حروف و اعداد استفاده شده باشد";
        const USERNAME_EXIST_ERR = "نام کاربری با این آیدی قبلا در سایت ثبت نام شده است";
        const USERNAME_MIN_ERR = "فیلد نام کاربری بایستی بیشتر از 6 حرف باشد";
        const EMAIL_VALID_ERR = "ایمیل وارد شده تنها بایستی جیمیل یا یاهو باشد";
        const EMAIL_EXIST_ERR = "ایمیلی با این نام قبلا در سایت ثبت نام شده است";
        const EMAIL_NOT_EXIST_ERR = "ایمیلی با این نام قبلا در سایت ثبت نام نشده است";
        const PASS_EMP_ERR = "فیلد پسورد نمی تواند خالی باشد";
        const PASS_NUMLET_ERR = "فیلد پسورد می تواند از حروف و اعداد استفاده شده باشد";
        const PASS_MIN_ERR = "فیلد پسورد بایستی بیشتر از 6 حرف باشد";
        const WRONG_INFO = "اطلاعات وارد شده صحیح نمی باشد";
        
    }
