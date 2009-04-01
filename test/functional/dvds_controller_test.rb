require 'test_helper'

class DvdsControllerTest < ActionController::TestCase
  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:dvds)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create dvds" do
    assert_difference('Dvds.count') do
      post :create, :dvds => { }
    end

    assert_redirected_to dvds_path(assigns(:dvds))
  end

  test "should show dvds" do
    get :show, :id => dvds(:one).to_param
    assert_response :success
  end

  test "should get edit" do
    get :edit, :id => dvds(:one).to_param
    assert_response :success
  end

  test "should update dvds" do
    put :update, :id => dvds(:one).to_param, :dvds => { }
    assert_redirected_to dvds_path(assigns(:dvds))
  end

  test "should destroy dvds" do
    assert_difference('Dvds.count', -1) do
      delete :destroy, :id => dvds(:one).to_param
    end

    assert_redirected_to dvds_path
  end
end
