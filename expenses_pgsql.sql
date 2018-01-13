CREATE TABLE public."user"
(
    user_id SERIAL PRIMARY KEY NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
CREATE UNIQUE INDEX user_user_id_uindex ON public."user" (user_id);

CREATE TABLE public.access_token
(
  access_token_id SERIAL PRIMARY KEY NOT NULL,
  user_id INT NOT NULL,
  token VARCHAR(255) NOT NULL,
  expiry_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  CONSTRAINT access_token_user_user_id_fk FOREIGN KEY (user_id) REFERENCES "user" (user_id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE UNIQUE INDEX access_token_access_token_id_uindex ON public.access_token (access_token_id);

CREATE TABLE public.expense
(
    expense_id SERIAL PRIMARY KEY NOT NULL,
    user_id INT NOT NULL,
    note VARCHAR(255),
    cost DECIMAL(10,2) DEFAULT 0.00 NOT NULL,
    spent_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT expense_user_user_id_fk FOREIGN KEY (user_id) REFERENCES "user" (user_id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE UNIQUE INDEX expense_expense_id_uindex ON public.expense (expense_id);