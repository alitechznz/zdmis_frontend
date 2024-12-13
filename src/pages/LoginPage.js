import React from 'react';
import { Container, Row, Col, Card, CardBody, Form, FormGroup, Label, Input, Button } from 'reactstrap';
import './LoginPage.css'; // Import custom styles

const LoginPage = () => {
  return (
    <div className="background-container">
      <Container fluid className="vh-100 d-flex justify-content-center align-items-center">
        <Row className="w-100">
          <Col xs={12} sm={10} md={8} lg={6} xl={5} className="mx-auto">
            <Card className="login-card shadow-lg">
              <CardBody>
                <div className="text-center mb-4">
                  <img
                    src={require('../assets/images/smz_logo.png')}  // Adjusted logo path
                    alt="Zanzibar Government Logo"
                    className="smz-logo img-fluid"
                  />
                  <p className="system-subtitle">The Revolutionary Government of Zanzibar</p>
                  <h5 className="system-name">Zanzibar Disaster Management Information System</h5>
                </div>
                <Form>
                  <FormGroup>
                    <Label for="username">Username</Label>
                    <Input
                      type="text"
                      name="username"
                      id="username"
                      placeholder="Enter your username"
                      required
                    />
                  </FormGroup>
                  <FormGroup>
                    <Label for="password">Password</Label>
                    <Input
                      type="password"
                      name="password"
                      id="password"
                      placeholder="Enter your password"
                      required
                    />
                  </FormGroup>
                  <Button color="primary" block>Login</Button>
                </Form>
                <div className="text-center mt-4">
                  <p className="copyright">
                    Copyright ©2016-2024 e-Government Authority. All Rights Reserved | e-Office Version 5.0.0
                  </p>
                </div>
              </CardBody>
            </Card>
          </Col>
        </Row>
      </Container>
    </div>
  );
};

export default LoginPage;
